<?php
namespace  Quiz\Modules\View;

/**
 * Interface ModuleInterface
 * @package Quiz\Aware
 */
interface ModuleInterface {

    /**
     * Get module config
     *
     * @return \stdClass
     */
    public function getConfig() : \stdClass;

    /**
     * Get "lazy" module repository
     *
     * @return RepositoryInterface
     */
    public function getRepository() : RepositoryInterface;
}