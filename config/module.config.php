<?php
/**
 * AxalianAchievements Configuration
 *
 * @category  AxalianAchievements
 * @package
 * @author    Michel Maas <michel@michelmaas.com>
 */
return array(
    'assetic_configuration' => array(
        // Use on production environment
        // 'debug'              => false,
        // 'buildOnRequest'     => false,

        'routes' => array(
            'home' => array(
                '@achievements_js',
                '@achievements_css',
            ),
        ),
        // Use on development environment
        'debug' => true,
        'buildOnRequest' => true,

        // This is optional flag, by default set to `true`.
        // In debug mode allow you to combine all assets to one file.
        // 'combine' => false,

        // this is specific to this project
        'webPath' => realpath('public/assets'),
        'basePath' => 'assets',

        'modules' => array(
            'AxalianAchievements' => array(
                'root_path' => __DIR__ . '/../assets',

                'collections' => array(
                    'achievements_css' => array(
                        'assets' => array(
                            'css/achievements.css',
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            ),
                        ),
                    ),
                    'achievements_js' => array(
                        'assets' => array(
                            'js/bootstrap-notify.js',
                            'js/jquery.axalian-achievements.js',
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
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