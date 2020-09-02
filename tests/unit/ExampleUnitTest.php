<?php
/**
 * animate plugin for Craft CMS 3.x
 *
 * this will animate elements using AOS
 *
 * @link      swdevteam.com
 * @copyright Copyright (c) 2020 Tim Strawbridge
 */

namespace swdevelopment\animatetests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use swdevelopment\animate\Animate;

/**
 * ExampleUnitTest
 *
 *
 * @author    Tim Strawbridge
 * @package   Animate
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            Animate::class,
            Animate::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
