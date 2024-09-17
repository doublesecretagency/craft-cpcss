<?php
/**
 * Control Panel CSS plugin for Craft CMS
 *
 * Add custom CSS to your Control Panel.
 *
 * @author    Double Secret Agency
 * @link      https://www.doublesecretagency.com/
 * @copyright Copyright (c) 2014 Double Secret Agency
 */

namespace doublesecretagency\cpcss;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\TemplateEvent;
use craft\web\View;
use doublesecretagency\cpcss\models\Settings;
use doublesecretagency\cpcss\web\assets\CustomAssets;
use yii\base\Event;

/**
 * Class CpCss
 * @since 2.0.0
 */
class CpCss extends Plugin
{
    /**
     * @var CpCss Self-referential plugin property.
     */
    public static CpCss $plugin;

    /**
     * @var bool The plugin has a settings page.
     */
    public bool $hasCpSettings = true;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // If not control panel request, bail
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return;
        }

        // Load CSS before page template is rendered
        Event::on(
            View::class,
            View::EVENT_BEFORE_RENDER_PAGE_TEMPLATE,
            function(TemplateEvent $event) {

                // Get view
                $view = Craft::$app->getView();

                // Load CSS file
                $view->registerAssetBundle(CustomAssets::class);

                // Load additional CSS
                /** @var Settings $settings */
                $settings = $this->getSettings();
                $css = trim($settings->additionalCss);
                if ($css) {
                    $view->registerCss($css);
                }
            }
        );
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): ?string
    {
        // Get the override keys
        $overrideKeys = array_keys(Craft::$app->getConfig()->getConfigFromFile('cp-css'));

        return Craft::$app->getView()->renderTemplate('cp-css/settings', [
            'settings' => $this->getSettings(),
            'overrideKeys' => $overrideKeys,
            'docsUrl' => $this->documentationUrl,
        ]);
    }
}
