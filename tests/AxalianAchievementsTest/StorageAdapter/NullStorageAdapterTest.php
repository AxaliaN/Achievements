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
        $user = \Mockery::mock('AxalianAchievements\User\UserInterface');

        $this->assertEquals(array(), $this->adapter->getAchievementsForUser($user));
    }

    public function testIfTrueReturnedOnAward()
    {
        $user = \Mockery::mock('AxalianAchievements\User\UserInterface');
        $achievement = \Mockery::mock('AxalianAchievements\Entity\Achievement');

        $this->assertTrue($this->adapter->awardAchievementToUser($achievement, $user));
    }

    public function testIfTrueReturnedOnRemove()
    {
        $user = \Mockery::mock('AxalianAchievements\User\UserInterface');
        $achievement = \Mockery::mock('AxalianAchievements\Entity\Achievement');

        $this->assertTrue($this->adapter->removeAchievementFromUser($achievement, $user));
    }
}
 