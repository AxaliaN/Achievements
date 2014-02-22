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
    public function testIfExceptionThrownOnInvalidConfig()
    {
        $factory = new ModuleOptionsFactory();

        $serviceLocatorMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocatorMock->shouldReceive('get')->andReturn(array());

        $moduleOptions = $factory->createService($serviceLocatorMock);
    }
}
 