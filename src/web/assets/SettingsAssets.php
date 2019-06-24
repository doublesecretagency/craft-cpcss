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

namespace doublesecretagency\cpcss\web\assets;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Class SettingsAssets
 * @since 2.0.0
 */
class SettingsAssets extends AssetBundle
{

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        $this->sourcePath = '@doublesecretagency/cpcss/resources';
        $this->depends = [CpAsset::class];

        $this->css = [
            'css/codemirror.css',
            'css/blackboard.css',
        ];

        $this->js = [
            'js/codemirror-css.js',
            'js/blackboard.js',
        ];
    }

}
