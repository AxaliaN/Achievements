<?php
/**
 * AchievementProviderPluginManagerTest
 *
 * @category  AxalianAchievementsTest\AchievementProvider
 * @package   AxalianAchievementsTest\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\AchievementProvider;

use AxalianAchievements\AchievementProvider\AchievementProviderPluginManager;
use PHPUnit_Framework_TestCase;

class AchievementProviderPluginManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AchievementProviderPluginManager
     */
    protected $pluginManager;

    public function setUp()
    {
        $this->pluginManager = new AchievementProviderPluginManager();
    }

    public function testIfValidateValidatesCorrect()
    {
        $plugin = \Mockery::mock('AxalianAchievements\AchievementProvider\AchievementProviderInterface');
        $this->assertNull($this->pluginManager->validatePlugin($plugin));
    }

    /**
     * @expectedException \AxalianAchievements\Exception\RuntimeException
     */
    public function testIfExceptionThrownOnInvalidPlugin()
    {
        $plugin = \Mockery::mock('FooInterface');
        $this->pluginManager->validatePlugin($plugin);
    }
}
