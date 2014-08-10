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

    public function getVersion()
    {
        return '1.0.4';
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
        craft()->templates->includeCssResource('cpcss/css/settings.css');
        return craft()->templates->render('cpcss/_settings', array(
            'settings' => $this->getSettings(),
        ));
    }

    private function _renderCss()
    {
        $settings = $this->getSettings();
        if (trim($settings->cssFile)) {
            $filepath = craft()->config->parseEnvironmentString($settings->cssFile);
            if ($hash = @sha1_file($filepath)) {
                craft()->templates->includeCssFile($filepath.'?e='.$hash);
            } else {
                craft()->userSession->setError('Control Panel CSS - File does not exist ('.basename($filepath).')');
            }
        }
        if (trim($settings->additionalCss)) {
            craft()->templates->includeCss($settings->additionalCss);
        }
    }
    
}
