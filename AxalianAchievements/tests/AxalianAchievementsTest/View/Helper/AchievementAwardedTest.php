<?php
/**
 * AchievementAwardedTest
 *
 * @category  AxalianAchievementsTest\View\Helper
 * @package   AxalianAchievementsTest\View\Helper
 * @author    Michel Maas <michel@michelmaas.com>
 */


namespace AxalianAchievementsTest\View\Helper;

use AxalianAchievements\View\Helper\AchievementAwarded;
use PHPUnit_Framework_TestCase;

class AchievementAwardedTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AchievementAwarded
     */
    protected $helper;

    public function setUp()
    {
        $serviceMock = \Mockery::mock('AxalianAchievements\Service\AchievementService');

        $this->achievementMock1 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_1')
            ->getMock();

        $this->achievementMock2 = \Mockery::mock('AxalianAchievements\Entity\Achievement')
            ->shouldReceive('getEvent')
            ->andReturn('test_event_2')
            ->getMock();

        $achievements = array(
            $this->achievementMock1,
            $this->achievementMock2,
        );

        $serviceMock->shouldReceive('getAwardedAchievements')->andReturn($achievements);

        $this->helper = new AchievementAwarded($serviceMock);

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
 