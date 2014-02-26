<?php
/**
 * AchievementTest
 *
 * @category  AxalianAchievementsTest\Entity
 * @package   AxalianAchievementsTest\Entity
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievementsTest\Entity;

use AxalianAchievements\Entity\Achievement;
use PHPUnit_Framework_TestCase;

class AchievementTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Achievement
     */
    protected $entity;

    public function setUp()
    {
        $data = array(
            'id' => 'foobar',
            'title' => 'Test achievement',
            'description' => 'This is a test achievement',
            'image' => 'foobar.png',
            'points' => 10,
            'multiple' => false,
            'event' => 'test_case',
            'category' => \Mockery::mock('AxalianAchievements\Entity\Category')
        );

        $this->entity = new Achievement($data['id'], $data);
    }

    public function testGetters()
    {
        $this->assertEquals('foobar', $this->entity->getId());
        $this->assertEquals('Test achievement', $this->entity->getTitle());
        $this->assertEquals('This is a test achievement', $this->entity->getDescription());
        $this->assertEquals('foobar.png', $this->entity->getImage());
        $this->assertEquals('test_case', $this->entity->getEvent());
        $this->assertEquals(10, $this->entity->getPoints());
        $this->assertInstanceOf('AxalianAchievements\Entity\Category', $this->entity->getCategory());
        $this->assertFalse($this->entity->getMultiple());
    }
}
 