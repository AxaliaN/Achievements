<?php
/**
 * ConfigAchievementProvider
 *
 * @category  AxalianAchievements\AchievementProvider
 * @package   AxalianAchievements\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\AchievementProvider;

use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\Entity\Category;

class ConfigAchievementProvider implements AchievementProviderInterface
{
    /**
     * @var array
     */
    protected $achievements;

    /**
     * @var array
     */
    protected $categories;

    public function __construct(array $config)
    {

        if (isset($config['categories'])) {
            $this->setCategories($config['categories']);
        }

        if (isset($config['categories'])) {
            $this->setAchievements($config['achievements']);
        }
    }

    /**
     * @return array
     */
    public function getAchievements()
    {
        return $this->achievements;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $achievements
     * @return ConfigAchievementProvider
     */
    public function setAchievements($achievements)
    {
        foreach($achievements as $achievementID => $achievementConfig) {
            $this->achievements[] = new Achievement($achievementID, $achievementConfig);
        }

        return $this;
    }

    /**
     * @param array $categories
     * @return ConfigAchievementProvider
     */
    public function setCategories($categories)
    {
        foreach($categories as $categoryID => $categoryConfig) {
            $this->categories[] = new Category($categoryID, $categoryConfig);
        }

        return $this;
    }
}
 