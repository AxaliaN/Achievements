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
        'routes' => array(
            'home' => array(
                '@achievements_js',
                '@achievements_css',
            ),
        ),
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
);