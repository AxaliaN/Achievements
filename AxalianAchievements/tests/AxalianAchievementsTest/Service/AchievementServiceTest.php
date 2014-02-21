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
    protected $achievement1;

    /**
     * @var Mock
     */
    protected $achievement2;

    public function setUp()
    {
        $this->achievement1 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_1')
            ->getMock();

        $this->achievement2 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_2')
            ->getMock();

        $moduleOptions = \Mockery::mock('AxalianAchievements\Options\ModuleOptions');
        $moduleOptions->shouldReceive('getAchievements')->andReturn(
            array(
                array(
                    'id' => 'testEvent1',
                    'event' => 'test_event_1'
                ),
                array(
                    'id' => 'testEvent1',
                    'event' => 'test_event_2'
                ),
            )
        );

        $moduleOptions->shouldReceive('getCategories')->andReturn(
            array(
                \Mockery::mock('AxalianAchievements\Entity\Category'),
                \Mockery::mock('AxalianAchievements\Entity\Category'),
                \Mockery::mock('AxalianAchievements\Entity\Category'),
            )
        );

        $this->service = new AchievementService($moduleOptions);
    }

    public function testIfConstructsCorrectly()
    {
        $this->assertCount(3, $this->service->getCategories());
        $this->assertCount(2, $this->service->getAchievements());
    }

    public function testIfAchievementCanBeRetrievedByEvent()
    {
        $this->assertEquals('test_event_1', $this->service->getAchievementByEvent('test_event_1')->getEvent());
        $this->assertEquals('test_event_1', $this->service->getAchievementByEvent('test_event_1_remove')->getEvent());
        $this->assertEquals('test_event_2', $this->service->getAchievementByEvent('test_event_2')->getEvent());
        $this->assertEquals('test_event_2', $this->service->getAchievementByEvent('test_event_2_remove')->getEvent());
        $this->assertNull($this->service->getAchievementByEvent('test_event_3'));
        $this->assertNull($this->service->getAchievementByEvent('test_event_3_remove'));
    }

    public function testIfAwardedAchievementsAreCollected()
    {
        $this->service->addAwardedAchievement($this->achievement1);
        $this->service->addAwardedAchievement($this->achievement2);

        $this->assertEquals(array($this->achievement1, $this->achievement2), $this->service->getAwardedAchievements());
    }

    public function testIfRemovedAchievementsAreCollected()
    {
        $this->service->addRemovedAchievement($this->achievement1);
        $this->service->addRemovedAchievement($this->achievement2);

        $this->assertEquals(array($this->achievement1, $this->achievement2), $this->service->getRemovedAchievements());
    }
}
 