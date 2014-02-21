<?php
/**
 * CategoryTest
 *
 * @category  AxalianAchievementsTest\AxalianAchievementsTest\Entity
 * @package   AxalianAchievementsTest\AxalianAchievementsTest\Entity
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievementsTest\AxalianAchievementsTest\Entity;

use AxalianAchievements\Entity\Category;

class CategoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Category
     */
    protected $entity;

    public function setUp()
    {
        $data = array(
            'id' => 'foobar',
            'title' => 'Test category',
            'description' => 'This is a test category',
            'image' => 'foobar.png',
        );

        $this->entity = new Category($data['id'], $data);
    }

    public function testGetters()
    {
        $this->assertEquals('foobar', $this->entity->getId());
        $this->assertEquals('Test category', $this->entity->getTitle());
        $this->assertEquals('This is a test category', $this->entity->getDescription());
        $this->assertEquals('foobar.png', $this->entity->getImage());
    }
}
 