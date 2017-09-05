<?php
require_once __DIR__.'/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);

$dic = new \Quiz\DependencyContainer(
    new \Quiz\Registry()
);

try {

    $routes = require 'router.config.php';

    // Register using modules
    $dic->register('Quiz', new Quiz\Modules\Question\Module( $dic ));
    $dic->register('User', new Quiz\Modules\User\Module( $dic ));

    // Define router
    $router = new \Quiz\Router($dic, $_REQUEST);
    $router->add($routes)
        ->resolve()
        ->dispatch();

    var_dump($router);
    exit;

} catch (\Exception $e) {
    echo $e;
}