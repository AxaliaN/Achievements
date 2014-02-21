<?php
/**
 * AbstractServiceFactoryTest
 *
 * @category  AxalianAchievementsTest\ServiceFactory
 * @package   AxalianAchievementsTest\ServiceFactory
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievementsTest\ServiceFactory;


use Mockery\Mock;
use Zend\Config\Config;

class AbstractServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mock
     */
    protected $serviceLocator;

    public function setUp()
    {
        $this->serviceLocator = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator->shouldReceive('getServiceLocator')->andReturn($this->serviceLocator);
    }

    /**
     * @dataProvider serviceFactories
     */
    public function testServiceFactories($class, $dependencies, $returnDependencies)
    {
        foreach ($dependencies as $dependency) {
            $this->serviceLocator->shouldReceive('get')->with($dependency)->andReturn($returnDependencies[$dependency])->getMock();
        }

        $factory = new $class;
        $factory->createService($this->serviceLocator);
    }

    public function serviceFactories()
    {
        $moduleOptionsMock = \Mockery::mock('AxalianAchievements\Options\ModuleOptions')->shouldReceive('getAchievements')->andReturn(array())->getMock()
            ->shouldReceive('getCategories')->andReturn(array())->getMock();

        return array(
            'AchievementListenerAggregateFactory' => array('AxalianAchievements\ServiceFactory\EventManager\AchievementListenerAggregateFactory', array('AxalianAchievements\Service\AchievementService'), array('AxalianAchievements\Service\AchievementService' => \Mockery::mock('AxalianAchievements\Service\AchievementService'))),
            'ModuleOptionsFactory' => array('AxalianAchievements\ServiceFactory\Options\ModuleOptionsFactory', array('Config'), array('Config' => new Config(array('axalian_achievements' => array())))),
            'AchievementServiceFactory' => array('AxalianAchievements\ServiceFactory\Service\AchievementServiceFactory', array('AxalianAchievements\Options\ModuleOptions'), array('AxalianAchievements\Options\ModuleOptions' => $moduleOptionsMock)),
            'AchievementAwardedFactory' => array('AxalianAchievements\ServiceFactory\View\Helper\AchievementAwardedFactory', array('AxalianAchievements\Service\AchievementService'), array('AxalianAchievements\Service\AchievementService' => \Mockery::mock('AxalianAchievements\Service\AchievementService'))),
            'AchievementRemovedFactory' => array('AxalianAchievements\ServiceFactory\View\Helper\AchievementRemovedFactory', array('AxalianAchievements\Service\AchievementService'), array('AxalianAchievements\Service\AchievementService' => \Mockery::mock('AxalianAchievements\Service\AchievementService'))),
        );
    }
}
 