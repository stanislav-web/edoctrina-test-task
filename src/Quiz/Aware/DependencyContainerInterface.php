<?php
namespace Quiz\Aware;

use Quiz\Exceptions\DependencyContainerException;

/**
 * Interface DependencyContainerInterface
 * @package Quiz\Aware
 */
interface DependencyContainerInterface {

    /**
     * Set module
     *
     * @param string                $moduleName
     * @param mixed                $moduleInstance
     *
     * @throws DependencyContainerException
     *
     * @return DependencyContainerInterface
     */
    public function register($moduleName, $moduleInstance) : DependencyContainerInterface;

    /**
     * Get module
     *
     * @param string $moduleName
     *
     * @throws DependencyContainerException
     * @return mixed
     */
    public function get($moduleName);
}