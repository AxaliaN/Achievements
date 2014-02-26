<?php
/**
 * AchievementAwardedFactory
 *
 * @category  AxalianAchievements\View\Helper
 * @package   AxalianAchievements\View\Helper
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\ServiceFactory\View\Helper;

use AxalianAchievements\View\Helper\AchievementAwarded;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AchievementAwardedFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AchievementAwarded
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AchievementAwarded($serviceLocator->getServiceLocator()->get('AxalianAchievements\Service\AchievementService'));
    }
}
 