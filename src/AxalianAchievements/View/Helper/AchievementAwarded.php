<?php
/**
 * AchievementAwarded
 *
 * @category AxalianAchievements\View\Helper
 * @package  AxalianAchievements\View\Helper
 * @author   Michel Maas <michel@michelmaas.com>
 * @method   string \Zend\View\Helper\Partial partial($name = null, $values = null)
 */

namespace AxalianAchievements\View\Helper;

use Zend\View\Renderer\PhpRenderer;

class AchievementAwarded extends AbstractAchievementViewHelper
{
    /**
     * @param string $partial
     * @return self
     */
    public function __invoke($partial = 'partials/axalian_achievements/achievement_awarded')
    {
        $this->partial = $partial;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        /** @var PhpRenderer $view */
        $view = $this->getView();

        return $view->partial(
            $this->partial,
            array(
                'achievements' => $this->getService()->getAwardedAchievements()
            )
        );
    }

}
 
