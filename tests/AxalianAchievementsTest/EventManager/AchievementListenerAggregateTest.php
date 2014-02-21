<?php
/**
 * AchievementListenerAggregateTest
 *
 * @category  AxalianAchievementsTest\EventManager
 * @package   AxalianAchievementsTest\EventManager
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\EventManager;

use AxalianAchievements\EventManager\AchievementListenerAggregate;
use Mockery\Mock;
use PHPUnit_Framework_TestCase;
use Zend\EventManager\EventManager;

class AchievementListenerAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AchievementListenerAggregate
     */
    protected $listenerAggregate;

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
        $service = \Mockery::mock('AxalianAchievements\Service\AchievementService');

        $this->achievement1 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_1')
            ->getMock();

        $this->achievement2 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_2')
            ->getMock();

        $achievements = array(
            $this->achievement1,
            $this->achievement2,
        );

        $service->shouldReceive('getAchievements')->andReturn($achievements);

        $service->shouldReceive('getAchievementByEvent')->with('test_event_1')->andReturn($this->achievement1);
        $service->shouldReceive('getAchievementByEvent')->with('test_event_1_remove')->andReturn($this->achievement1);
        $service->shouldReceive('getAchievementByEvent')->with('test_event_2')->andReturn($this->achievement2);
        $service->shouldReceive('getAchievementByEvent')->with('test_event_2_remove')->andReturn($this->achievement2);

        $service->shouldDeferMissing();

        $this->listenerAggregate = new AchievementListenerAggregate($service);
    }

    public function testIfConstructedCorrectly()
    {
        $this->assertInstanceOf('AxalianAchievements\Service\AchievementService', $this->listenerAggregate->getService());
    }

    public function testIfAttachAttachesListeners()
    {
        $eventManager = new EventManager();

        $this->listenerAggregate->attach($eventManager);

        $this->assertCount(4, $eventManager->getEvents());
        $this->assertContains('test_event_1', $eventManager->getEvents());
        $this->assertContains('test_event_1_remove', $eventManager->getEvents());
        $this->assertContains('test_event_2', $eventManager->getEvents());
        $this->assertContains('test_event_2_remove', $eventManager->getEvents());
    }

    public function testIfDetachDetachesListeners()
    {
        $eventManager = new EventManager();

        $this->listenerAggregate->attach($eventManager);
        $this->listenerAggregate->detach($eventManager);

        $this->assertCount(0, $eventManager->getEvents());
        $this->assertNotContains('test_event_1', $eventManager->getEvents());
        $this->assertNotContains('test_event_1_remove', $eventManager->getEvents());
        $this->assertNotContains('test_event_2', $eventManager->getEvents());
        $this->assertNotContains('test_event_2_remove', $eventManager->getEvents());
    }

    public function testIfAchievementsCanBeAwarded()
    {
        $eventManager = new EventManager();

        $this->listenerAggregate->attach($eventManager);

        $eventManager->trigger('test_event_1');
        $eventManager->trigger('test_event_2_remove');

        $this->assertContains($this->achievement1, $this->listenerAggregate->getService()->getAwardedAchievements());
        $this->assertContains($this->achievement2, $this->listenerAggregate->getService()->getRemovedAchievements());
    }
}
 