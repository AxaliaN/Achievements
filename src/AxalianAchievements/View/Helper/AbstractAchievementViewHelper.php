<?php
/**
 * AbstractAchievementViewHelper
 *
 * @category  AxalianAchievements\View\Helper
 * @package   AxalianAchievements\View\Helper
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\View\Helper;

use AxalianAchievements\Service\AchievementService;
use Zend\View\Helper\AbstractHelper;

class AbstractAchievementViewHelper extends AbstractHelper
{
    /**
     * @var AchievementService
     */
    protected $service;

    /**
     * @var string
     */
    protected $partial;

    /**
     * @param AchievementService $service
     */
    public function __construct(AchievementService $service)
    {
        $this->setService($service);
    }

    /**
     * @return \AxalianAchievements\Service\AchievementService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \AxalianAchievements\Service\AchievementService $service
     * @return AchievementAwarded
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string
     */
    public function getPartial()
    {
        return $this->partial;
    }

    /**
     * @param string $partial
     * @return AchievementAwarded
     */
    public function setPartial($partial)
    {
        $this->partial = $partial;

        return $this;
    }
}
