<?php
/**
 * ModuleOptions
 *
 * @category  AxalianAchievements\Options
 * @package   AxalianAchievements\Options
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var array
     */
    protected $achievements;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @var string
     */
    protected $achievement_config;

    /**
     * @return array
     */
    public function getAchievements()
    {
        return $this->achievements;
    }

    /**
     * @param array $achievements
     * @return self
     */
    public function setAchievements($achievements)
    {
        $this->achievements = $achievements;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return ModuleOptions
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return string
     */
    public function getAchievementConfig()
    {
        return $this->achievement_config;
    }

    /**
     * @param string $achievement_config
     * @return ModuleOptions
     */
    public function setAchievementConfig($achievement_config)
    {
        $this->achievement_config = $achievement_config;

        return $this;
    }
}
 