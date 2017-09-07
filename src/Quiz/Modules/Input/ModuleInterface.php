<?php
namespace  Quiz\Modules\Input;

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
     * @throws InputException
     *
     * @return Repository
     */
    public function getRepository() : Repository;
}