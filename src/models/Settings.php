<?php
/**
 * animate plugin for Craft CMS 3.x
 *
 * this will animate elements using AOS
 *
 * @link      swdevteam.com
 * @copyright Copyright (c) 2020 Tim Strawbridge
 */

namespace swdevelopment\animate\models;

use swdevelopment\animate\Animate;

use Craft;
use craft\base\Model;

/**
 * Animate Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Tim Strawbridge
 * @package   Animate
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */

    // public $animateToolbar = true;
    public $activateAnimate = false;
    public $useOnEveryElement = false;
    public $useCDN = false;

    public $defaultSettings = [
      'offset'=>120,
      'delay'=>0,
      'duration'=>400,
      'easing'=>'ease',
      'once'=>false,
      'mirror'=>false,
      'anchorPlacement'=>'top-bottom'
    ];

    public $offset,$delay,$duration;
    public $easing = ['match' => 0];

    public $fades = [
      array( 'effect' => 'fade', 'usage' => 'data-aos="fade"' ),
      array( 'effect' => 'fade-up', 'usage' => 'data-aos="fade-up"' ),
      array( 'effect' => 'fade-down', 'usage' => 'data-aos="fade-down"' ),
      array( 'effect' => 'fade-left', 'usage' => 'data-aos="fade-left"' ),
      array( 'effect' => 'fade-right', 'usage' => 'data-aos="fade-right"' ),
      array( 'effect' => 'fade-up-right', 'usage' => 'data-aos="fade-up-right"' ),
      array( 'effect' => 'fade-up-left', 'usage' => 'data-aos="fade-up-left"' ),
      array( 'effect' => 'fade-down-right', 'usage' => 'data-aos="fade-down-right"' ),
      array( 'effect' => 'fade-down-left', 'usage' => 'data-aos="fade-down-left"' ),


    ];

    public $flips = [
      array( 'effect' => 'flip-up', 'usage' => 'data-aos="flip-up"' ),
      array( 'effect' => 'flip-down', 'usage' => 'data-aos="flip-down"' ),
      array( 'effect' => 'flip-left', 'usage' => 'data-aos="flip-left"' ),
      array( 'effect' => 'flip-right', 'usage' => 'data-aos="flip-right"' ),
    ];

    public $slides = [

      array( 'effect' => 'slide-up', 'usage' => 'data-aos="slide-up"' ),
      array( 'effect' => 'slide-down', 'usage' => 'data-aos="slide-down"' ),
      array( 'effect' => 'slide-left', 'usage' => 'data-aos="slide-left"' ),
      array( 'effect' => 'slide-right', 'usage' => 'data-aos="slide-right"' ),

    ];

    public $zooms = [
      array( 'effect' => 'zoom-in', 'usage' => 'data-aos="zoom-in"' ),
      array( 'effect' => 'zoom-in-up', 'usage' => 'data-aos="zoom-in-up"' ),
      array( 'effect' => 'zoom-in-down', 'usage' => 'data-aos="zoom-in-down"' ),
      array( 'effect' => 'zoom-in-left', 'usage' => 'data-aos="zoom-in-left"' ),
      array( 'effect' => 'zoom-in-right', 'usage' => 'data-aos="zoom-in-right"' ),
      array( 'effect' => 'zoom-out', 'usage' => 'data-aos="zoom-out"' ),
      array( 'effect' => 'zoom-out-up', 'usage' => 'data-aos="zoom-out-up"' ),
      array( 'effect' => 'zoom-out-down', 'usage' => 'data-aos="zoom-out-down"' ),
      array( 'effect' => 'zoom-out-left', 'usage' => 'data-aos="zoom-out-left"' ),
      array( 'effect' => 'zoom-out-right', 'usage' => 'data-aos="zoom-out-right"' ),

    ];

    public $animateOptions = [
      'fade','fade-up','fade-down','fade-left','fade-right','fade-up-right','fade-up-left','fade-down-right','fade-down-left',
      'flip-up','flip-down','flip-left','flip-right','slide-up','slide-down','slide-left','slide-right','zoom-in','zoom-in-up','zoom-in-down','zoom-in-left','zoom-in-right','zoom-out','zoom-out-up','zoom-out-down','zoom-out-left','zoom-out-right'
    ];

    public $easingOpts = [
      'linear',
      'ease',
      'ease-in',
      'ease-out',
      'ease-in-out',
      'ease-in-back',
      'ease-out-back',
      'ease-in-out-back',
      'ease-in-sine',
      'ease-out-sine',
      'ease-in-out-sine',
      'ease-in-quad',
      'ease-out-quad',
      'ease-in-out-quad',
      'ease-in-cubic',
      'ease-out-cubic',
      'ease-in-quart',
      'ease-out-quart',
      'ease-in-out-quart',
    ];


    public $useDefaultSettings = false;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            //['someAttribute', 'string'],
            //['someAttribute', 'default', 'value' => 'Some Default'],
        ];
    }
}
