<?php
/**
 * StorageAdapterInterface
 *
 * @category  AxalianAchievements\StorageAdapter
 * @package   AxalianAchievements\StorageAdapter
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\StorageAdapter;

use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\User\UserInterface;

interface StorageAdapterInterface
{
    /**
     * @param UserInterface $user
     * @return array
     */
    public function getAchievementsForUser(UserInterface $user);

    /**
     * @param UserInterface $user
     * @param Achievement $achievement
     * @return bool
     */
    public function awardAchievementToUser(Achievement $achievement, UserInterface $user);

    /**
     * @param UserInterface $user
     * @param Achievement $achievement
     * @return bool
     */
    public function removeAchievementFromUser(Achievement $achievement, UserInterface $user);
}
