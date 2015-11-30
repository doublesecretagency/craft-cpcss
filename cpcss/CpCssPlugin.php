<?php
namespace Craft;

class CpCssPlugin extends BasePlugin
{

    public function init()
    {
        parent::init();
        if (craft()->request->isCpRequest()) {
            $this->_renderCss();
        }
    }

    public function getName()
    {
        return Craft::t('Control Panel CSS');
    }

    public function getDescription()
    {
        return 'Add custom CSS to your Control Panel.';
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/lindseydiloreto/craft-cpcss';
    }

    public function getVersion()
    {
        return '1.1.0';
    }

    public function getSchemaVersion()
    {
        return '1.1.0';
    }

    public function getDeveloper()
    {
        return 'Double Secret Agency';
    }

    public function getDeveloperUrl()
    {
        return 'https://github.com/lindseydiloreto/craft-cpcss';
        //return 'http://doublesecretagency.com';
    }

    protected function defineSettings()
    {
        return array(
            'cssFile'       => array(AttributeType::String),
            'additionalCss' => array(AttributeType::String, 'column' => ColumnType::Text),
        );
    }

    public function getSettingsHtml()
    {
        $this->_loadCodeMirror();
        return craft()->templates->render('cpcss/_settings', array(
            'settings' => $this->getSettings(),
        ));
    }

    private function _loadCodeMirror()
    {
        if ($this->_actualSettingsPage()) {
            craft()->templates->includeCssResource('cpcss/css/codemirror.css');
            craft()->templates->includeCssResource('cpcss/css/blackboard.css');
            craft()->templates->includeJsResource('cpcss/js/codemirror-css.js');
            craft()->templates->includeJs('
$(function () {
    CodeMirror.fromTextArea(document.getElementById("settings-additionalCss"), {
        indentUnit: 4,
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true,
        theme: "blackboard"
    });
});', true);
        }
    }

    private function _actualSettingsPage()
    {
        $currentUrl = craft()->request->getUrl();
        $admin = craft()->config->get('cpTrigger');
        return ("/$admin/settings/plugins/cpcss" == $currentUrl);
    }

    private function _renderCss()
    {
        $settings = $this->getSettings();
        if (trim($settings->cssFile)) {
            $filepath = craft()->config->parseEnvironmentString($settings->cssFile);
            if ($hash = @sha1_file($filepath)) {
                craft()->templates->includeCssFile($filepath.'?e='.$hash);
            } else {
                craft()->templates->includeCssFile($filepath);
            }
        }
        if (trim($settings->additionalCss)) {
            craft()->templates->includeCss($settings->additionalCss);
        }
    }

}
