<?php
/**
 * AchievementRemovedFactory
 *
 * @category  AxalianAchievements\View\Helper
 * @package   AxalianAchievements\View\Helper
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\ServiceFactory\View\Helper;

use AxalianAchievements\View\Helper\AchievementRemoved;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AchievementRemovedFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AchievementRemoved
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AchievementRemoved(
            $serviceLocator->getServiceLocator()->get('AxalianAchievements\Service\AchievementService')
        );
    }
}
