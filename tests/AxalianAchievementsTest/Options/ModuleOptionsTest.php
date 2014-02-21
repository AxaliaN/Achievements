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
        $categories = array(
            \Mockery::mock('AxalianAchievements\Entity\Category'),
            \Mockery::mock('AxalianAchievements\Entity\Category'),
            \Mockery::mock('AxalianAchievements\Entity\Category'),
        );

        $achievements = array(
            \Mockery::mock('AxalianAchievements\Entity\Achievement'),
            \Mockery::mock('AxalianAchievements\Entity\Achievement'),
            \Mockery::mock('AxalianAchievements\Entity\Achievement'),
        );

        $this->moduleOptions->setCategories($categories);
        $this->moduleOptions->setAchievements($achievements);
        $this->moduleOptions->setAchievementConfig('config');

        $this->assertEquals('config', $this->moduleOptions->getAchievementConfig());
        $this->assertEquals($achievements, $this->moduleOptions->getAchievements());
        $this->assertEquals($categories, $this->moduleOptions->getCategories());
    }
}
 