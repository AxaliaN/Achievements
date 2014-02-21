<?php
/**
 * AchievementListenerAggregateFactory
 *
 * @category  AxalianAchievements\EventManager\ServiceFactory
 * @package   AxalianAchievements\EventManager\ServiceFactory
 * @author    Michel Maas <michel@michelmaas.com>
 */
 
namespace AxalianAchievements\ServiceFactory\EventManager;

use AxalianAchievements\Options\ModuleOptions;
use AxalianAchievements\EventManager\AchievementListenerAggregate;
use AxalianAchievements\Service\AchievementService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AchievementListenerAggregateFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AchievementListenerAggregate
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var AchievementService $achievementService */
        $achievementService = $serviceLocator->get('AxalianAchievements\Service\AchievementService');

        return new AchievementListenerAggregate($achievementService);
    }
}
 