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
use craft\base\Plugin;
use craft\events\TemplateEvent;
use craft\web\View;
use doublesecretagency\cpcss\models\Settings;
use doublesecretagency\cpcss\web\assets\CustomAssets;
use doublesecretagency\cpcss\web\assets\SettingsAssets;
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
    public static $plugin;

    /**
     * @var bool The plugin has a settings page.
     */
    public $hasCpSettings = true;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // If not control panel request, bail
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return false;
        }

        // Load CSS before template is rendered
        Event::on(
            View::class,
            View::EVENT_BEFORE_RENDER_TEMPLATE,
            function (TemplateEvent $event) {

                // Get view
                $view = Craft::$app->getView();

                // Load CSS file
                $view->registerAssetBundle(CustomAssets::class);

                // Load additional CSS
                $settings = $this->getSettings();
                $css = trim($settings->additionalCss);
                if ($css) {
                    $view->registerCss($css);
                }

            }
        );
    }

    /**
     * @return Settings Plugin settings model.
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @return string The fully rendered settings template.
     */
    protected function settingsHtml(): string
    {
        $view = Craft::$app->getView();
        $view->registerAssetBundle(SettingsAssets::class);

        $overrideKeys = array_keys(Craft::$app->getConfig()->getConfigFromFile('cp-css'));

        return $view->renderTemplate('cp-css/settings', [
            'settings' => $this->getSettings(),
            'overrideKeys' => $overrideKeys,
            'docsUrl' => $this->documentationUrl,
        ]);
    }

}
