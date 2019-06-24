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

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use doublesecretagency\cpcss\CpCss;

/**
 * Class CustomAssets
 * @since 2.1.0
 */
class CustomAssets extends AssetBundle
{

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        $this->depends = [CpAsset::class];

        $settings = CpCss::$plugin->getSettings();

        $file = trim(Craft::parseEnv($settings['cssFile']));

        if ($file) {

            // Cache buster
            if ($hash = @sha1_file($file)) {
                $file .= '?e='.$hash;
            }

            // Load CSS file
            $this->css = [$file];

        }
    }

}
