<?php
/**
 * AchievementServiceFactory
 *
 * @category  AxalianAchievements\Service
 * @package   AxalianAchievements\Service
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\ServiceFactory\Service;

use AxalianAchievements\AchievementProvider\AchievementProviderPluginManager;
use AxalianAchievements\Options\ModuleOptions;
use AxalianAchievements\Service\AchievementService;
use AxalianAchievements\StorageAdapter\StorageAdapterInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AchievementServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AchievementService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var AchievementProviderPluginManager $pluginManager */
        $pluginManager = $serviceLocator->get(
            'AxalianAchievements\AchievementProvider\AchievementProviderPluginManager'
        );

        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $serviceLocator->get('AxalianAchievements\Options\ModuleOptions');

        /** @var StorageAdapterInterface $storageAdapter */
        $storageAdapter = $serviceLocator->get($moduleOptions->getStorageAdapter());

        return new AchievementService($pluginManager, $storageAdapter);
    }
}
