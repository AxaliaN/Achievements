<?php
/**
 * AchievementProviderInterface
 *
 * @category  AxalianAchievements\AchievementProvider
 * @package   AxalianAchievements\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\AchievementProvider;

interface AchievementProviderInterface
{
    /**
     * @return array
     */
    public function getAchievements();

    /**
     * @return array
     */
    public function getCategories();
}
 