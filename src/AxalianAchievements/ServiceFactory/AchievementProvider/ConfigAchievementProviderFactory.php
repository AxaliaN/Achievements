<?php
/**
 * ConfigAchievementProviderFactory
 *
 * @category  AxalianAchievements\ServiceFactory\AchievementProvider
 * @package   AxalianAchievements\ServiceFactory\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\ServiceFactory\AchievementProvider;

use AxalianAchievements\AchievementProvider\ConfigAchievementProvider;
use AxalianAchievements\Exception\RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigAchievementProviderFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \AxalianAchievements\Exception\RuntimeException
     * @return ConfigAchievementProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('Config');

        if (!isset($config['axalian_achievements_config_provider'])) {
            throw new RuntimeException('No valid axalian_achievements_config_provider key set in config');
        }

        return new ConfigAchievementProvider($config['axalian_achievements_config_provider']);
    }
}
 