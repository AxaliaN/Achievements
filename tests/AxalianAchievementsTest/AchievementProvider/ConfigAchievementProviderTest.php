<?php
/**
 * ConfigAchievementProviderTest
 *
 * @category  AxalianAchievementsTest\AchievementProvider
 * @package   AxalianAchievementsTest\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\AchievementProvider;

use AxalianAchievements\AchievementProvider\ConfigAchievementProvider;
use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\Entity\Category;
use PHPUnit_Framework_TestCase;

class ConfigAchievementProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigAchievementProvider
     */
    protected $provider;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @var array
     */
    protected $achievements;

    /**
     * @var array
     */
    protected $achievementEntities;

    /**
     * @var array
     */
    protected $categoryEntities;

    public function setUp()
    {
        $this->categories = array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'General site achievements',
                    'image' => 'general.png',
                ),
                'social' => array(
                    'title' => 'Social',
                    'description' => 'Social achievements',
                    'image' => 'social.png',
                )
        );

        $this->achievements = array(
            'visited_site' => array(
                'category' => 'General',
                'title' => 'Visited site!',
                'description' => 'You visited the site!',
                'name' => 'site_visit',
                'points' => 10,
                'image' => 'visit.png',
            ),
            'posted_comment' => array(
                'category' => 'social',
                'title' => 'Commented!',
                'description' => 'You posted a comment!',
                'name' => 'site_visit',
                'points' => 10,
                'image' => 'visit.png',
            ),
        );

        $config = array(
            'categories' => $this->categories,
            'achievements' => $this->achievements
        );


        foreach ($this->categories as $id => $categoryConfig) {
            $this->categoryEntities[] = new Category($id, $categoryConfig);
        }

        foreach ($this->achievements as $id => $achievementConfig) {
            $this->achievementEntities[] = new Achievement($id, $achievementConfig);
        }

        $this->provider = new ConfigAchievementProvider($config);
    }

    public function testIfConstructedCorrectly()
    {
        $this->assertEquals($this->achievementEntities, $this->provider->getAchievements());
        $this->assertEquals($this->categoryEntities, $this->provider->getCategories());
    }
}
