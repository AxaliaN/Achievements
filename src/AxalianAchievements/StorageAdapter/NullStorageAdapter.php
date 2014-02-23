<?php
/**
 * The NullStorageAdapter doesn't actually store any achievements.
 * It just receives them and send them into the void.
 *
 * @category  AxalianAchievements\StorageAdapter
 * @package   AxalianAchievements\StorageAdapter
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievements\StorageAdapter;


use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\User\UserInterface;

class NullStorageAdapter implements StorageAdapterInterface
{

    /**
     * {@inheritDoc}
     */
    public function getAchievementsForUser(UserInterface $user)
    {
        return array();
    }

    /**
     * {@inheritDoc}
     */
    public function awardAchievementToUser(Achievement $achievement, UserInterface $user)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function removeAchievementFromUser(Achievement $achievement, UserInterface $user)
    {
        return true;
    }
}
 