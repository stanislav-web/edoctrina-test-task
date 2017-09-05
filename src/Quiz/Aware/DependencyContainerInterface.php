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
     * @param ModuleInterface $moduleInstance
     *
     * @throws DependencyContainerException
     *
     * @return DependencyContainerInterface
     */
    public function register($moduleName, ModuleInterface $moduleInstance) : DependencyContainerInterface;

    /**
     * Get module
     *
     * @param string $moduleName
     *
     * @throws DependencyContainerException
     * @return ModuleInterface
     */
    public function get($moduleName) : ModuleInterface;
}