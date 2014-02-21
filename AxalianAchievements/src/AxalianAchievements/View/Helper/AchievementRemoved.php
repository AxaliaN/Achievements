<?php
/**
 * AchievementAwarded
 *
 * @category  AxalianAchievements\View\Helper
 * @package   AxalianAchievements\View\Helper
 * @author    Michel Maas <michel@michelmaas.com>
 */
 

namespace AxalianAchievements\View\Helper;

class AchievementRemoved extends AbstractAchievementViewHelper
{
    /**
     * @param string $partial
     * @return self
     */
    public function __invoke($partial = 'partials/axalian_achievements/achievement_removed')
    {
        $this->partial = $partial;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getView()->partial(
            $this->partial,
            array(
                'achievements' => $this->getService()->getRemovedAchievements()
            )
        );
    }
}
 