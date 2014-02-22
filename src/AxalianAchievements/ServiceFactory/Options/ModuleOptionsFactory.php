<?php
/**
 * ModuleOptionsFactory
 *
 * @category  AxalianAchievements\ServiceFactory\Options
 * @package   AxalianAchievements\ServiceFactory\Options
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\ServiceFactory\Options;

use AxalianAchievements\Exception\RuntimeException;
use AxalianAchievements\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \AxalianAchievements\Exception\RuntimeException
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $moduleOptions */
        $config = $serviceLocator->get('Config');

        if (!isset($config['axalian_achievements'])) {
            throw new RuntimeException('No valid "axalian_achievements" config set');
        }

        return new ModuleOptions($config['axalian_achievements']);
    }
}
 