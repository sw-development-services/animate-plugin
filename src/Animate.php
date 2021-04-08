<?php
/**
 * animate plugin for Craft CMS 3.x
 *
 * this will animate elements using AOS
 *
 * @link      swdevteam.com
 * @copyright Copyright (c) 2020 Tim Strawbridge
 */

namespace swdevelopment\animate;

use swdevelopment\animate\variables\AnimateVariable;
use swdevelopment\animate\models\Settings;
use swdevelopment\animate\web\assets\animate\AnimateAsset;

use Yii;
use yii\base\Event;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\events\TemplateEvent;
use craft\web\View;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://docs.craftcms.com/v3/extend/
 *
 * @author    Tim Strawbridge
 * @package   Animate
 * @since     1.0.0
 *
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class Animate extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Animate::$plugin
     *
     * @var Animate
     */
    public static $plugin;

    /** @var array $_lockRead Whether the composer.lock file been read already. */
    protected $_lockRead = false;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * Set to `true` if the plugin should have a settings view in the control panel.
     *
     * @var bool
     */
    public $hasCpSettings = true;

    /**
     * Set to `true` if the plugin should have its own section (main nav item) in the control panel.
     *
     * @var bool
     */
    public $hasCpSection = false;

    public $versions = [
        'animate' => '1.0.9'
    ];

    public $useCDN = false;

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * Animate::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // If control panel request then lets get out of here
        if (Craft::$app->getRequest()->getIsCpRequest()) {
          return false;

        }

        // Register our site routes
        /*Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'animate/default';
            }
        );

        // Register our CP routes
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['cpActionTrigger1'] = 'animate/default/do-something';
            }
        ); */

        if ($this->getSettings()->activateAnimate) {
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function (TemplateEvent $event) {
                    Animate::$plugin->loadAnimate();
                }
            );
        }

        // Register our variables
        /*Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                //$variable = $event->sender;
                //$variable->set('animate', AnimateVariable::class);
            //}
        //); */

        // Do something after we're installed
        /*Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                }
            }
        );*/




/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 *
 * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
 *
 * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
 * the category to the method (prefixed with the fully qualified class name) where the constant appears.
 *
 * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
 * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
 *
 * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
 */
        Craft::info(
            Craft::t(
                'animate',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    public function loadAnimate(){
      // Get view
      $view = Craft::$app->getView();
      // Load current library versions
      // $this->loadAnimateVersion();

      $settings = $this->getSettings();
      $this->useCDN = $this->settings->useCDN;

      $environment = Craft::$app->getConfig()->env;

      // if we are in production, lets load only from the CDN
      if($environment == "production"){
        $this->useCDN = true;
      }

      // fixed bug where css would be ovewritten on page
      $view->registerAssetBundle( AnimateAsset::class );


    }

    public function loadAnimateVersion(){
      // If versions have already been determined, bail
      if ($this->_lockRead) {
        return;
      }

      // Mark composer.lock as read
      $this->_lockRead = true;

      // Locate composer.lock file
      $filename = Yii::getAlias('@root/composer.lock');

      // Get composer.lock file contents
      $lock = @file_get_contents($filename);

      // If unable to retrieve lock file, bail
      if (!$lock) {
        return;
      }

      // Convert to JSON data
      $json = @json_decode($lock, true);

      // check if file is json
      if (!$json) {
        return;
      }

      foreach ($json['packages'] as $package){
        switch ($package['name']){
          case 'swdevelopment/animate':
            $name    = preg_replace('/^[^\/]*\//', '', $package['name']);
            $version = preg_replace('/[^0-9\.]/', '', $package['version']);
            $this->versions[$name] = $version;
            break;

        }
      }

      // print_r( $this->versions[$name] );

    }



    // Protected Methods
    // =========================================================================

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'animate/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
