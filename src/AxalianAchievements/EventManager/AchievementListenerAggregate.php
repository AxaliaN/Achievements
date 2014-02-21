<?php
/**
 * AchievementListenerAggregate
 *
 * @category  AxalianAchievements\src\AxalianAchievements\EventManager
 * @package   AxalianAchievements\src\AxalianAchievements\EventManager
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievements\EventManager;


use AxalianAchievements\Entity\Achievement;
use AxalianAchievements\Options\ModuleOptions;
use AxalianAchievements\Service\AchievementService;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class AchievementListenerAggregate implements ListenerAggregateInterface
{
    /**
     * @var array
     */
    protected $listeners;

    /**
     * @var AchievementService
     */
    protected $service;

    public function __construct(AchievementService $service)
    {
        $this->setService($service);
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        /** @var Achievement $achievement */
        foreach($this->getService()->getAchievements() as $achievement) {
            $this->listeners[] = $events->attach($achievement->getEvent(), array($this, 'awardAchievement'));
            $this->listeners[] = $events->attach($achievement->getEvent() . '_remove', array($this, 'removeAwardedAchievement'));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function awardAchievement(EventInterface $e)
    {
        $achievement = $this->getService()->getAchievementByEvent($e->getName());

        if ($achievement) {
            $this->getService()->addAwardedAchievement($achievement);
        }
    }

    public function removeAwardedAchievement(EventInterface $e)
    {
        $achievement = $this->getService()->getAchievementByEvent($e->getName());

        if ($achievement) {
            $this->getService()->addRemovedAchievement($achievement);
        }
    }

    /**
     * @return AchievementService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param AchievementService $service
     * @return AchievementListenerAggregate
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }
}
 