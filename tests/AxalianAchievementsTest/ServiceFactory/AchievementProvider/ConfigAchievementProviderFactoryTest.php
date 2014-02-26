<?php
/**
 * ConfigAchievementProviderFactory
 *
 * @category  AxalianAchievementsTest\ServiceFactory\AchievementProvider
 * @package   AxalianAchievementsTest\ServiceFactory\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievementsTest\ServiceFactory\AchievementProvider;


use AxalianAchievements\ServiceFactory\AchievementProvider\ConfigAchievementProviderFactory;
use PHPUnit_Framework_TestCase;

class ConfigAchievementProviderFactoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \AxalianAchievements\Exception\RuntimeException
     * @expectedExceptionMessage No valid axalian_achievements_config_provider key set in config
     */
    public function testIfExceptionThrownOnInvalidConfig()
    {
        $factory = new ConfigAchievementProviderFactory();

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn(array());
        $serviceLocatorMock->shouldReceive('getServiceLocator')->andReturn($serviceLocatorMock);

        $factory->createService($serviceLocatorMock);
    }

    public function testIfCanCreateService()
    {
        $factory = new ConfigAchievementProviderFactory();

        $config = array(
            'axalian_achievements_config_provider' => array()
        );

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn($config);
        $serviceLocatorMock->shouldReceive('getServiceLocator')->andReturn($serviceLocatorMock);

        $factory->createService($serviceLocatorMock);
    }
}
 