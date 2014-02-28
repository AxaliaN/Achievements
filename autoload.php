<?php
/**
 * Setup autoloading
 */

include_once __DIR__ . '/../../autoload.php';

$loader = new Zend\Loader\StandardAutoloader(
    array(
        Zend\Loader\StandardAutoloader::LOAD_NS => array(
            'AxalianAchievements' => __DIR__ . '/src/AxalianAchievements',
            'AxalianAchievementsTest' => __DIR__ . '/tests/AxalianAchievements',
        ),
    )
);
$loader->register();
