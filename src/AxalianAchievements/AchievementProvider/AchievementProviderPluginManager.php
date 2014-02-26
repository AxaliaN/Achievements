<?php
/**
 * AchievementProviderPluginManager
 *
 * @category  AxalianAchievements\AchievementProvider
 * @package   AxalianAchievements\AchievementProvider
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\AchievementProvider;

use AxalianAchievements\Exception\RuntimeException;
use Zend\ServiceManager\AbstractPluginManager;

class AchievementProviderPluginManager extends AbstractPluginManager
{
    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @throws RuntimeException
     * @return void
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof AchievementProviderInterface) {
            return; // we're okay
        }

        throw new RuntimeException(
            sprintf(
                'Plugin of type %s is invalid; must implement AxalianAchievements\AchievementProvider\AchievementProviderInterface',
                (is_object($plugin) ? get_class($plugin) : gettype($plugin))
            )
        );
    }
}