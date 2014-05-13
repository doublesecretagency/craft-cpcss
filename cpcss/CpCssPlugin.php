<?php
namespace Craft;

class CpCssPlugin extends BasePlugin
{

	public function init()
	{
		parent::init();
		if ($this->_isCp()) {
			$this->_renderCss();
		}
	}

	public function getName()
	{
		return Craft::t('Control Panel CSS');
	}

	public function getVersion()
	{
		return '0.9.9';
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
			'cpCss' => array(AttributeType::String, 'column' => ColumnType::Text),
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('cpcss/_settings', array(
			'cpCss' => $this->getSettings()->cpCss,
		));
	}

	private function _isCp()
	{
		$currentUrl = craft()->request->getUrl();
		$admin = craft()->config->get('cpTrigger');
		return (strpos($currentUrl, "/$admin/") !== false);
	}

	private function _renderCss()
	{
		$css = $this->getSettings()->cpCss;
		craft()->templates->includeCss($css);
	}
	
}
