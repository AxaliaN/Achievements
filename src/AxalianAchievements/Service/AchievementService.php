<?php
/**
 * AchievementService
 *
 * @category  AxalianAchievements\Service
 * @package   AxalianAchievements\Service
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievements\Service;


use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\Options\ModuleOptions;

class AchievementService
{
    /**
     * @var array
     */
    protected $awardedAchievements = array();

    /**
     * @var array
     */
    protected $removedAchievements = array();

    /**
     * @var array
     */
    protected $achievements;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @param ModuleOptions $moduleOptions
     */
    public function __construct(ModuleOptions $moduleOptions)
    {
        $this->setAchievements($moduleOptions->getAchievements())
             ->setCategories($moduleOptions->getCategories());
    }

    /**
     * Retrieve an achievement by using its event name
     *
     * @param string $eventName Name of the event to look for
     * @return \AxalianAchievements\Entity\Achievement|null  The found event, or null of nothing found
     */
    public function getAchievementByEvent($eventName)
    {
        /** @var Achievement $achievement */
        foreach($this->getAchievements() as $achievement) {
            if($achievement->getEvent() == $eventName || ($achievement->getEvent() . '_remove') == $eventName) {
                return $achievement;
            }
        }

        return null;
    }

    /**
     * @param Achievement $achievement
     */
    public function addAwardedAchievement(Achievement $achievement)
    {
        $this->awardedAchievements[] = $achievement;
    }

    /**
     * @param Achievement $achievement
     */
    public function addRemovedAchievement(Achievement $achievement)
    {
        $this->removedAchievements[] = $achievement;
    }

    /**
     * @return array
     */
    public function getAwardedAchievements()
    {
        return $this->awardedAchievements;
    }

    /**
     * @return array
     */
    public function getRemovedAchievements()
    {
        return $this->removedAchievements;
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
     * @return self
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

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
        foreach($achievements as $id => $achievementConfig) {
            $achievement = new Achievement($id, $achievementConfig);

            if ($achievement) {
                $this->achievements[] = $achievement;
            }
        }

        return $this;
    }
}
 