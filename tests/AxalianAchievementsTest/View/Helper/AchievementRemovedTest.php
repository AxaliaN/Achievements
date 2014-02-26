<?php
/**
 * AchievementAwardedTest
 *
 * @category  AxalianAchievementsTest\View\Helper
 * @package   AxalianAchievementsTest\View\Helper
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\View\Helper;

use AxalianAchievements\View\Helper\AchievementRemoved;
use PHPUnit_Framework_TestCase;

class AchievementRemovedTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AchievementRemoved
     */
    protected $helper;

    public function setUp()
    {
        $serviceMock = \Mockery::mock('AxalianAchievements\Service\AchievementService');

        $achievementMock1 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_1')
            ->getMock();

        $achievementMock2 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_2')
            ->getMock();

        $achievements = array(
            $achievementMock1,
            $achievementMock2,
        );

        $serviceMock->shouldReceive('getRemovedAchievements')->andReturn($achievements);

        $this->helper = new AchievementRemoved($serviceMock);

        $viewMock = \Mockery::mock('Zend\View\Renderer\PhpRenderer');
        $viewMock->shouldReceive('partial')->andReturn('foobar');
        $this->helper->setView($viewMock);
    }

    public function testIfInvokesCorrectly()
    {
        $this->helper->__invoke('test-partial');

        $this->assertEquals('test-partial', $this->helper->getPartial());
    }

    public function testIfPartialCanBeSet()
    {
        $this->helper->setPartial('foo-bar');

        $this->assertEquals('foo-bar', $this->helper->getPartial());
    }

    public function testIfToStringReturnString()
    {
        $this->assertEquals('foobar', $this->helper->__toString());
    }
}
