<?php
/**
 * ModuleOptions
 *
 * @category  AxalianAchievements\Options
 * @package   AxalianAchievements\Options
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var array
     */
    protected $achievement_providers;

    /**
     * @var string
     */
    protected $storage_adapter;

    /**
     * @return array
     */
    public function getAchievementProviders()
    {
        return $this->achievement_providers;
    }

    /**
     * @param array $achievement_providers
     * @return ModuleOptions
     */
    public function setAchievementProviders($achievement_providers)
    {
        $this->achievement_providers = $achievement_providers;

        return $this;
    }

    /**
     * @return string
     */
    public function getStorageAdapter()
    {
        return $this->storage_adapter;
    }

    /**
     * @param string $storage_adapter
     * @return ModuleOptions
     */
    public function setStorageAdapter($storage_adapter)
    {
        $this->storage_adapter = $storage_adapter;

        return $this;
    }
}
 