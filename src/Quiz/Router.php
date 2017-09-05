<?php
namespace Quiz;

use Quiz\Aware\DependencyContainerInterface;
use Quiz\Aware\RouterInterface;
use Quiz\Exceptions\RouterException;

/**
 * Class Router
 * @package Quiz
 */
final class Router implements RouterInterface {

    /**
     * @var DependencyContainerInterface $di
     */
    private $di;

    /**
     * Request params
     *
     * @var array $requestParams
     */
    private $requestParams;

    /**
     * Routes
     *
     * @var array $routes
     */
    private $routes = [];

    /**
     * @var string $controller
     */
    private $controller;

    /**
     * @var string $action
     */
    private $action;

    /**
     * Router constructor.
     *
     * @param DependencyContainerInterface $di
     * @param array                        $requestParams
     */
    public function __construct(DependencyContainerInterface $di, array $requestParams) {
        $this->di = $di;
        $this->requestParams = $requestParams;
    }

    /**
     * Add routes
     *
     * @param array $routes
     *
     * @return RouterInterface
     */
    public function add(array $routes) : RouterInterface {
        $this->routes = $routes;

        return $this;
    }

    /**
     * Get application path
     *
     * @throws RouterException
     * @return string
     */
    private function getApplicationPath() : string {
        if(true === isset($this->routes['path'])) {
            return trim($this->routes['path'],'\\').'\\';
        }

        throw new RouterException('Routes path does not configured');
    }

    /**
     * Get default controller
     *
     * @throws RouterException
     * @return string
     */
    private function getDefaultController() : string {
        return $this->getApplicationPath()
                .ucfirst($this->routes['default']['controller']).'Controller';

    }

    /**
     * Get default action
     *
     * @return string
     */
    private function getDefaultAction() : string {
        return strtolower($this->routes['default']['action']).'Action';
    }

    /**
     * Get current controller
     *
     * @throws RouterException
     * @return string
     */
    private function getCurrentController() : string {

        if(null === $this->controller && true === isset($this->requestParams['controller'])) {

            $controller = $this->getApplicationPath().ucfirst($this->requestParams['controller']).'Controller';

            if(false === class_exists($controller)) {
                throw new RouterException('Controller does not found');
            }
        } else {
            $controller = $this->getDefaultController();
        }

        return $controller;
    }

    /**
     * Get current controller
     *
     * @return string
     */
    private function getCurrentAction() : string {

        if(null === $this->action && true === isset($this->requestParams['action'])) {

            $action = strtolower($this->requestParams['action']) . 'Action';
            if (false === method_exists($this->controller, $action)) {
                $action = $this->getDefaultAction();
            }
        } else {
            $action = $this->getDefaultAction();
        }

        return $action;
    }

    /**
     * Resolve routes
     *
     * @throws RouterException
     * @return RouterInterface
     */
    public function resolve() : RouterInterface {

        $this->controller = $this->getCurrentController();
        $this->action = $this->getCurrentAction();

        return $this;
    }

    /**
     * Dispatch controller
     *
     * @return void
     */
    public function dispatch() : \void {
        $controller = new $this->controller($this->di);
        $controller->{$this->action}();

        return null;
    }
}