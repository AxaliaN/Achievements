<?php
/**
 * Module
 *
 * @category  AxalianAchievements
 * @package   AxalianAchievements
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ServiceProviderInterface, ViewHelperProviderInterface
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AxalianAchievements\Options\ModuleOptions' => 'AxalianAchievements\ServiceFactory\Options\ModuleOptionsFactory',
                'AxalianAchievements\Service\AchievementService' => 'AxalianAchievements\ServiceFactory\Service\AchievementServiceFactory',
                'AxalianAchievements\AchievementProvider\AchievementProviderPluginManager' => 'AxalianAchievements\ServiceFactory\AchievementProvider\AchievementProviderPluginManagerFactory',
            ),
            'invokables' => array(
                'AxalianAchievements\StorageAdapter\NullStorageAdapter' => 'AxalianAchievements\StorageAdapter\NullStorageAdapter',
            )
        );
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'AchievementAwarded' => 'AxalianAchievements\ServiceFactory\View\Helper\AchievementAwardedFactory',
                'AchievementRemoved' => 'AxalianAchievements\ServiceFactory\View\Helper\AchievementRemovedFactory',
            )
        );
    }
}
