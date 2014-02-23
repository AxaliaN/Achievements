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
use AxalianAchievements\StorageAdapter\StorageAdapterInterface;
use AxalianAchievements\User\UserInterface;

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
     * @var StorageAdapterInterface
     */
    protected $storage;

    /**
     * @param AchievementProviderPluginManager $pluginManager
     * @param StorageAdapterInterface $storage
     */
    public function __construct(AchievementProviderPluginManager $pluginManager, StorageAdapterInterface $storage)
    {
        $this->setPluginManager($pluginManager);
        $this->setStorage($storage);
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

            /* @var Category $category */
            foreach ($categories as $category) {
                $result[$category->getID()] = $category;
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
     * Gets all achievements for a category
     *
     * @param Category $category
     * @return array
     */
    public function getAchievementsByCategory(Category $category)
    {
        $achievements = array();

        /** @var Achievement $achievement */
        foreach($this->getAchievements() as $achievement) {
            if($achievement->getCategory() == $category) {
                $achievements[] = $achievement;
            }
        }

        return $achievements;
    }

    /**
     * @param Achievement $achievement
     * @param UserInterface $user
     */
    public function addAwardedAchievement(Achievement $achievement, UserInterface $user = null)
    {
        $this->awardedAchievements[] = $achievement;

        if ($user !== null) {
            $this->getStorage()->awardAchievementToUser($achievement, $user);
        }
    }

    /**
     * @param Achievement $achievement
     * @param UserInterface $user
     */
    public function addRemovedAchievement(Achievement $achievement, UserInterface $user = null)
    {
        $this->removedAchievements[] = $achievement;

        if ($user !== null) {
            $this->getStorage()->removeAchievementFromUser($achievement, $user);
        }
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

    /**
     * @return \AxalianAchievements\StorageAdapter\StorageAdapterInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param \AxalianAchievements\StorageAdapter\StorageAdapterInterface $storage
     * @return AchievementService
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;

        return $this;
    }
}
 