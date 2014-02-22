<?php
/**
 * Achievement
 *
 * @category  AxalianAchievements\Entity
 * @package   AxalianAchievements\Entity
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\Entity;

class Achievement extends AbstractAchievementEntity
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var int
     */
    protected $points;

    /**
     * @var string
     */
    protected $event;

    /**
     * @var bool
     */
    protected $multiple;

    /**
     * @return \AxalianAchievements\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \AxalianAchievements\Entity\Category $category
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return self
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     * @return self
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     * @return self
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * @param string $description
     * @return Achievement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
 