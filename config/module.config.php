<?php
/**
 * AxalianAchievements Configuration
 *
 * @category  AxalianAchievements
 * @package
 * @author    Michel Maas <michel@michelmaas.com>
 */
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'axalian_achievements' => array(
        'achievement_config' => 'config',
        'categories' => array(),
        'achievements' => array(),
    )
);