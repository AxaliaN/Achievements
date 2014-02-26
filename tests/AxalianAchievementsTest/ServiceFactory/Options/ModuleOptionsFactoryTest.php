<?php
/**
 * ModuleOptionsFactoryTest
 *
 * @category  AxalianAchievementsTest\ServiceFactory\Options
 * @package   AxalianAchievementsTest\ServiceFactory\Options
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\ServiceFactory\Options;

use AxalianAchievements\ServiceFactory\Options\ModuleOptionsFactory;
use PHPUnit_Framework_TestCase;

class ModuleOptionsFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \AxalianAchievements\Exception\RuntimeException
     * @expectedExceptionMessage No valid "axalian_achievements" config set
     */
    public function testIfExceptionThrownOnMissingConfig()
    {
        $factory = new ModuleOptionsFactory();

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn(array());

        $factory->createService($serviceLocatorMock);
    }

    /**
     * @expectedException \AxalianAchievements\Exception\RuntimeException
     * @expectedExceptionMessage No valid "achievement_providers" config set in "axalian_achievements"
     */
    public function testIfExceptionThrownOnMissingAdapterConfig()
    {
        $factory = new ModuleOptionsFactory();

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn(array('axalian_achievements'=>array()));

        $factory->createService($serviceLocatorMock);
    }

    /**
     * @expectedException \AxalianAchievements\Exception\RuntimeException
     * @expectedExceptionMessage No valid "storage_adapter" config set in "axalian_achievements"
     */
    public function testIfExceptionThrownOnMissingStorageConfig()
    {
        $factory = new ModuleOptionsFactory();

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn(array('axalian_achievements'=>array('achievement_providers' => array())));

        $factory->createService($serviceLocatorMock);
    }

    public function testIfServiceCreatedOnValidConfig()
    {
        $factory = new ModuleOptionsFactory();

        $data = array(
            'axalian_achievements' => array(
                'achievement_providers' => array(
                    'factories' => array(
                        'foo' => 'bar'
                    ),
                    'invokables' => array(
                        'bar' => 'foo'
                    )
                ),
                'storage_adapter' => array(
                    'Foobar'
                )
            )
        );

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn($data);

        $service = $factory->createService($serviceLocatorMock);

        $this->assertInstanceOf('AxalianAchievements\Options\ModuleOptions', $service);
    }
}
 