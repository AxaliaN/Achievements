<?php
/**
 * AbstractAchievementEntity
 *
 * @category  AxalianAchievements\Entity
 * @package   AxalianAchievements\Entity
 * @author    Michel Maas <michel@michelmaas.com>
 */

namespace AxalianAchievements\Entity;

class AbstractAchievementEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @param string|int $id
     * @param array $config
     */
    public function __construct($id, $config)
    {
        // Just a precaution.
        if (isset($config['id'])) {
            unset($config['id']);
        }

        $this->setID($id);

        foreach ($config as $key => $value) {
            $setter = 'set' . ucfirst($key);

            $this->$setter($value);
        }
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AbstractAchievementEntity
     */
    public function setID($id)
    {
        $this->id = $id;

        return $this;
    }
}
