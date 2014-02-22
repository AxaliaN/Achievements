<?php
/**
 * AchievementProviderPluginManagerFactory
 *
 * @category  AxalianAchievements\ServiceFactory\AchievementProvider
 * @package   AxalianAchievements\ServiceFactory\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\ServiceFactory\AchievementProvider;

use AxalianAchievements\Options\ModuleOptions;
use AxalianAchievements\AchievementProvider\AchievementProviderPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AchievementProviderPluginManagerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AchievementProviderPluginManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $mapOptions */
        $moduleOptions = $serviceLocator->get('AxalianAchievements\Options\ModuleOptions');

        $pluginManager = new AchievementProviderPluginManager(new Config($moduleOptions->getAchievementProviders()));
        $pluginManager->setServiceLocator($serviceLocator);

        return $pluginManager;
    }
}
