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

        // Requires standard CP assets to be loaded first
        $this->depends = [CpAsset::class];

        // Get plugin settings
        $settings = CpCss::$plugin->getSettings();

        // Get the file (or files) specified
        $file = trim($settings['cssFile']);

        // If no file was specified, bail
        if (!$file) {
            return;
        }

        // Initialize a collection of paths
        $paths = [];

        // Allow for comma-separated file paths
        $files = explode(',', $file);

        // Loop through specified files
        foreach ($files as $file) {

            // Parse each filename for aliases
            $file = Craft::parseEnv(trim($file));

            // Bust the cache
            if ($hash = @sha1_file($file)) {
                $file .= '?e='.$hash;
            }

            // Add file to path collection
            $paths[] = $file;
        }

        // Load all files
        $this->css = $paths;
    }

}
