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
        'achievement_providers' => array(
            'factories' => array(
                'AxalianAchievements\AchievementProvider\ConfigAchievementProvider' => 'AxalianAchievements\ServiceFactory\AchievementProvider\ConfigAchievementProviderFactory'
            )
        ),
        'storage_adapter' => 'AxalianAchievements\StorageAdapter\NullStorageAdapter'
    ),
    'axalian_achievements_config_provider' => array(
        'categories' => array(
            'general' => array(
                'title' => 'General',
                'description' => 'General site achievements',
                'image' => 'general.png',
            ),
            'social' => array(
                'title' => 'Social',
                'description' => 'Social achievements',
                'image' => 'social.png',
            )
        ),
        'achievements' => array(
            'visited_site' => array(
                'category' => 'General',
                'title' => 'Visited site!',
                'description' => 'You visited the site!',
                'event' => 'site_visit',
                'points' => 10,
                'multiple' => true,
                'image' => 'visit.png',
            ),
            'visited_site_twice' => array(
                'category' => 'General',
                'title' => 'Visited site twice!',
                'description' => 'You visited the site twice!',
                'event' => 'site_visit_twice',
                'points' => 10,
                'multiple' => true,
                'image' => 'visit.png',
            )
        )
    )
);