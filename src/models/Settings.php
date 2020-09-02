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

    public $offset,$delay,$duration,$easing;

    public $animateOptions = [
      'fade','fade-up','fade-down','fade-left','fade-right','fade-up-right','fade-up-left','fade-down-right','fade-down-left',
      'flip-up','flip-down','flip-left','flip-right','slide-up','slide-down','slide-left','slide-right','zoom-in','zoom-in-up','zoom-in-down','zoom-in-left','zoom-in-right','zoom-out','zoom-out-up','zoom-out-down','zoom-out-left','zoom-out-right'
    ];

    public $easingOptions = [
      '','linear','ease','ease-in','ease-out','ease-in-out','ease-in-back','ease-out-back','ease-in-out-back','ease-in-sine','ease-out-sine','ease-in-out-sine','ease-in-quad','ease-out-quad','ease-in-out-quad','ease-in-cubic','ease-out-cubic','ease-in-quart','ease-out-quart','ease-in-out-quart'
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
