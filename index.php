<?php
require_once __DIR__.'/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);

$dic = new \Quiz\DependencyContainer(
    new \Quiz\Registry()
);

try {

    $routes = require 'router.config.php';

    // Register using modules
    $dic->register('Question', new Quiz\Modules\Question\Module( ));
    $dic->register('User', new Quiz\Modules\User\Module( ));
    $dic->register('View', new Quiz\Modules\View\Module( ));

    // Dispatch router
    $router = new \Quiz\Router($dic, $_REQUEST);
    $router->add($routes)
        ->resolve()
        ->dispatch();

} catch (\Exception $e) {
    echo $e;
}