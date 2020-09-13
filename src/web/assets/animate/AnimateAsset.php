<?php
/**
 * animate plugin for Craft CMS 3.x
 *
 * this will animate elements using AOS
 *
 * @link      swdevteam.com
 * @copyright Copyright (c) 2020 Tim Strawbridge
 */

namespace swdevelopment\animate\web\assets\animate;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use swdevelopment\animate\Animate;

/**
 * AnimateAsset AssetBundle
 *
 * AssetBundle represents a collection of asset files, such as CSS, JS, images.
 *
 * Each asset bundle has a unique name that globally identifies it among all asset bundles used in an application.
 * The name is the [fully qualified class name](http://php.net/manual/en/language.namespaces.rules.php)
 * of the class representing it.
 *
 * An asset bundle can depend on other asset bundles. When registering an asset bundle
 * with a view, all its dependent asset bundles will be automatically registered.
 *
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html
 *
 * @author    Tim Strawbridge
 * @package   Animate
 * @since     1.0.0
 */
class AnimateAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * Initializes the bundle.
     */
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = "@swdevelopment/animate/web/assets/animate/dist";

        // define the dependencies
        // fixed bug where css would be ovewritten on page
        $this->depends = [
            //CpAsset::class,                 // removed 09/13/2020 ~ TS
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered


        // check if we are loading via CDN
        if ( Animate::$plugin->useCDN ) {

          $this->js = [
            'https://unpkg.com/aos@2.3.1/dist/aos.js',
            'js/default-aos.js'
          ];

          $this->css = [
            'https://unpkg.com/aos@2.3.1/dist/aos.css',
          ];

        }else{
          // this will be a cpresource
          $this->js = [
              'js/aos.js',
              'js/default-aos.js'
          ];

          $this->css = [
              'css/aos.css',
          ];
        }


        parent::init();
    }
}
