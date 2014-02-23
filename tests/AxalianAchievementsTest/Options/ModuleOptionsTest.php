<?php
/**
 * ModuleOptionsTest
 *
 * @category  AxalianAchievements\Options
 * @package   AxalianAchievements\Options
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievementsTest\Options;


use AxalianAchievements\Options\ModuleOptions;
use PHPUnit_Framework_TestCase;

class ModuleOptionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleOptions
     */
    protected $moduleOptions;

    public function setUp()
    {
        $this->moduleOptions = new ModuleOptions();
    }

    public function testIfOptionsCanBeSetAndGet()
    {
        $providers = array(
            'factories' => array(
                'FooFactory'
            ),
            'invokables' => array(
                'BarInvokable'
            )
        );

        $storageAdapter = 'FooBarAdapter';

        $this->moduleOptions->setAchievementProviders($providers);
        $this->moduleOptions->setStorageAdapter($storageAdapter);

        $this->assertEquals($providers, $this->moduleOptions->getAchievementProviders());
        $this->assertEquals($storageAdapter, $this->moduleOptions->getStorageAdapter());
    }
}
 