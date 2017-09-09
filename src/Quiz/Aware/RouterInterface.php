<?php
namespace Quiz\Aware;

use Quiz\Exceptions\RouterException;

/**
 * Interface RouterInterface
 * @package Quiz\Aware
 */
interface RouterInterface {

    /**
     * Add routes
     *
     * @param array $routes
     *
     * @return RouterInterface
     */
    public function add(array $routes) : RouterInterface;

    /**
     * Resolve routes
     *
     * @throws RouterException
     * @return RouterInterface
     */
    public function resolve() : RouterInterface;

    /**
     * Dispatch controller
     *
     * @return bool
     */
    public function dispatch() : bool;

}