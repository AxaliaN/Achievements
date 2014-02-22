<?php
/**
 * AchievementServiceTest
 *
 * @category  AxalianAchievementsTest\Service
 * @package   AxalianAchievementsTest\Service
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\Service;

use AxalianAchievements\Service\AchievementService;
use Mockery\Mock;
use PHPUnit_Framework_TestCase;

class AchievementServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AchievementService
     */
    protected $service;

    /**
     * @var Mock
     */
    protected $pluginProvider;

    /**
     * @var array
     */
    protected $achievements;
    /**
     * @var array
     */
    protected $categories;

    public function setUp()
    {
        $this->pluginProvider = \Mockery::mock('AxalianAchievements\AchievementProvider\AchievementProviderPluginManager');

        $this->service = new AchievementService($this->pluginProvider);

        $this->achievements = array(
            1 => \Mockery::mock('AxalianAchievements\Entity\Achievement')->shouldReceive('getID')->andReturn(1)->getMock(),
            2 => \Mockery::mock('AxalianAchievements\Entity\Achievement')->shouldReceive('getID')->andReturn(2)->getMock(),
        );

        $this->categories = array(
            1 => \Mockery::mock('AxalianAchievements\Entity\Category')->shouldReceive('getID')->andReturn(1)->getMock(),
            2 => \Mockery::mock('AxalianAchievements\Entity\Category')->shouldReceive('getID')->andReturn(2)->getMock(),
        );
    }

    public function testIfConstructsCorrectly()
    {
        $this->assertInstanceOf('AxalianAchievements\AchievementProvider\AchievementProviderPluginManager', $this->service->getPluginManager());
    }

    public function testIfAchievementsCanBeRetrieved()
    {
        $providerMock = \Mockery::mock('AxalianAchievement\AchievementProvider\AchievementProviderInterface');
        $providerMock->shouldReceive('getAchievements')->andReturn($this->achievements);

        $this->pluginProvider->shouldReceive('getCanonicalNames')->andReturn(array($providerMock))->getMock();
        $this->pluginProvider->shouldReceive('get')->andReturn($providerMock);

        $achievements = $this->service->getAchievements();

        $this->assertEquals($this->achievements, $achievements);
    }

    public function testIfAchievementCanBeRetrievedByEvent()
    {
        $providerMock = \Mockery::mock('AxalianAchievement\AchievementProvider\AchievementProviderInterface');
        $providerMock->shouldReceive('getAchievements')->andReturn($this->achievements);

        $this->pluginProvider->shouldReceive('getCanonicalNames')->andReturn(array($providerMock))->getMock();
        $this->pluginProvider->shouldReceive('get')->andReturn($providerMock);

        $this->achievements[1]->shouldReceive('getEvent')->andReturn('foobar');
        $this->achievements[2]->shouldReceive('getEvent')->andReturn('foobaz');

        $achievement = $this->service->getAchievementByEvent('foobar');

        $this->assertEquals($this->achievements[1], $achievement);
    }

    public function testIfNullRetrievedOnNonExistingEvent()
    {
        $providerMock = \Mockery::mock('AxalianAchievement\AchievementProvider\AchievementProviderInterface');
        $providerMock->shouldReceive('getAchievements')->andReturn($this->achievements);

        $this->pluginProvider->shouldReceive('getCanonicalNames')->andReturn(array($providerMock))->getMock();
        $this->pluginProvider->shouldReceive('get')->andReturn($providerMock);

        $this->achievements[1]->shouldReceive('getEvent')->andReturn('foobar');
        $this->achievements[2]->shouldReceive('getEvent')->andReturn('foobaz');

        $achievement = $this->service->getAchievementByEvent('foobax');

        $this->assertNull($achievement);
    }

    public function testIfCategoriesCanBeRetrieved()
    {
        $providerMock = \Mockery::mock('AxalianAchievement\AchievementProvider\AchievementProviderInterface');
        $providerMock->shouldReceive('getCategories')->andReturn($this->categories);

        $this->pluginProvider->shouldReceive('getCanonicalNames')->andReturn(array($providerMock))->getMock();
        $this->pluginProvider->shouldReceive('get')->andReturn($providerMock);

        $categories = $this->service->getCategories();

        $this->assertEquals($this->categories, $categories);
    }

    public function testIfAwardedAchievementsAreCollected()
    {
        $this->service->addAwardedAchievement($this->achievements[1]);
        $this->service->addAwardedAchievement($this->achievements[2]);

        $this->assertEquals(array($this->achievements[1], $this->achievements[2]), $this->service->getAwardedAchievements());
    }

    public function testIfRemovedAchievementsAreCollected()
    {
        $this->service->addRemovedAchievement($this->achievements[1]);
        $this->service->addRemovedAchievement($this->achievements[2]);

        $this->assertEquals(array($this->achievements[1], $this->achievements[2]), $this->service->getRemovedAchievements());
    }
}
 