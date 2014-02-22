<?php
/**
 * AchievementService
 *
 * @category  AxalianAchievements\Service
 * @package   AxalianAchievements\Service
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\Service;

use AxalianAchievements\AchievementProvider\AchievementProviderInterface;
use AxalianAchievements\AchievementProvider\AchievementProviderPluginManager;
use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\Entity\Category;

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
     * @var AchievementProviderPluginManager
     */
    protected $pluginManager;

    /**
     * @param AchievementProviderPluginManager $pluginManager
     */
    public function __construct(AchievementProviderPluginManager $pluginManager)
    {
        $this->setPluginManager($pluginManager);
    }

    /**
     * @return array
     */
    public function getAchievements()
    {
        $result = array();

        foreach ($this->getProviders() as $provider) {
            $achievements = $provider->getAchievements();

            /* @var Achievement $achievement */
            foreach ($achievements as $achievement) {
                $result[$achievement->getID()] = $achievement;
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $result = array();

        foreach ($this->getProviders() as $provider) {
            $categories = $provider->getCategories();

            /* @var Category $categories */
            foreach ($categories as $category) {
                $result[$category->getId()] = $category;
            }
        }

        return $result;
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
     * Get all possible achievement providers
     *
     * @return AchievementProviderInterface[]
     */
    public function getProviders()
    {
        $providers = array();

        foreach ($this->getPluginManager()->getCanonicalNames() as $providerAlias) {
            $providers[] = $this->getPluginManager()->get($providerAlias);
        }

        return $providers;
    }

    /**
     * @return \AxalianAchievements\AchievementProvider\AchievementProviderPluginManager
     */
    public function getPluginManager()
    {
        return $this->pluginManager;
    }

    /**
     * @param \AxalianAchievements\AchievementProvider\AchievementProviderPluginManager $pluginManager
     * @return AchievementService
     */
    public function setPluginManager($pluginManager)
    {
        $this->pluginManager = $pluginManager;

        return $this;
    }
}
 