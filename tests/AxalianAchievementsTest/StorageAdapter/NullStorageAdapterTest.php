<?php
/**
 * NullStorageTest
 *
 * @category  AxalianAchievementsTest\StorageAdapter
 * @package   AxalianAchievementsTest\StorageAdapter
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\StorageAdapter;

use AxalianAchievements\StorageAdapter\NullStorageAdapter;
use PHPUnit_Framework_TestCase;

class NullStorageAdapterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var NullStorageAdapter
     */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new NullStorageAdapter();
    }

    public function testIfEmptyArrayReturnedOnGet()
    {
        $userMock = \Mockery::mock('AxalianAchievements\User\UserInterface');

        $this->assertEquals(array(), $this->adapter->getAchievementsForUser($userMock));
    }

    public function testIfTrueReturnedOnAward()
    {
        $userMock = \Mockery::mock('AxalianAchievements\User\UserInterface');
        $achievementMock = \Mockery::mock('AxalianAchievements\Entity\Achievement');

        $this->assertTrue($this->adapter->awardAchievementToUser($achievementMock, $userMock));
    }

    public function testIfTrueReturnedOnRemove()
    {
        $userMock = \Mockery::mock('AxalianAchievements\User\UserInterface');
        $achievementMock = \Mockery::mock('AxalianAchievements\Entity\Achievement');

        $this->assertTrue($this->adapter->removeAchievementFromUser($achievementMock, $userMock));
    }
}
