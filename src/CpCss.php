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

use doublesecretagency\cpcss\models\Settings;
use doublesecretagency\cpcss\web\assets\SettingsAssets;

/**
 * Class CpCss
 * @since 2.0.0
 */
class CpCss extends Plugin
{

    /** @var Plugin  $plugin  Self-referential plugin property. */
    public static $plugin;

    /** @var bool  $hasCpSettings  The plugin has a settings page. */
    public $hasCpSettings = true;

    /** @inheritDoc */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
        if (Craft::$app->getRequest()->getIsCpRequest()) {
            $this->_renderCss();
        }
    }

    /**
     * @return Settings  Plugin settings model.
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @return string  The fully rendered settings template.
     */
    protected function settingsHtml(): string
    {
        $this->_loadCodeMirror();
        $overrideKeys = array_keys(Craft::$app->getConfig()->getConfigFromFile('cp-css'));
        return Craft::$app->getView()->renderTemplate('cp-css/settings', [
            'settings' => $this->getSettings(),
            'overrideKeys' => $overrideKeys,
            'docsUrl' => $this->documentationUrl,
        ]);
    }

    /**
     * @return void
     */
    private function _loadCodeMirror()
    {
        $view = Craft::$app->getView();
        $view->registerAssetBundle(SettingsAssets::class);
        $view->registerJs('
$(function () {
    console.log("Loading CodeMirror...");
    CodeMirror.fromTextArea(document.getElementById("settings-additionalCss"), {
        indentUnit: 4,
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true,
        theme: "blackboard"
    });
});');
    }

    /**
     * @return void
     */
    private function _renderCss()
    {
        $view = Craft::$app->getView();
        $settings = $this->getSettings();
        if (trim($settings->cssFile)) {
            $filepath = $settings->cssFile;
            if ($hash = @sha1_file($filepath)) {
                $view->registerCssFile($filepath.'?e='.$hash);
            } else {
                $view->registerCssFile($filepath);
            }
        }
        if (trim($settings->additionalCss)) {
            $view->registerCss($settings->additionalCss);
        }
    }

}