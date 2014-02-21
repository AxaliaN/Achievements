<?php
/**
 * AchievementServiceFactory
 *
 * @category  AxalianAchievements\Service
 * @package   AxalianAchievements\Service
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievements\ServiceFactory\Service;


use AxalianAchievements\Options\ModuleOptions;
use AxalianAchievements\Service\AchievementService;
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
        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $serviceLocator->get('AxalianAchievements\Options\ModuleOptions');

        return new AchievementService($moduleOptions);
    }
}
 