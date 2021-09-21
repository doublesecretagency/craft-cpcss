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

namespace doublesecretagency\cpcss\models;

use craft\base\Model;

/**
 * Class Settings
 * @since 2.0.0
 */
class Settings extends Model
{

    /**
     * @var string Path for the CSS file to load in the control panel.
     */
    public $cssFile = '';

    /**
     * @var string Any additional CSS which may be added directly.
     */
    public $additionalCss = '';

    /**
     * @var bool Whether to enable the hash-based cache busting.
     */
    public $cacheBusting = true;

}
