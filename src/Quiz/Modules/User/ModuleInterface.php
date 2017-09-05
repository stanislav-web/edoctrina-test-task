<?php
namespace  Quiz\Modules\User;

/**
 * Interface ModuleInterface
 * @package Quiz\Aware
 */
interface ModuleInterface {

    /**
     * Set module repository
     *
     * @param Repository $repository
     *
     * @return ModuleInterface
     */
    public function setRepository(Repository $repository) : ModuleInterface;

    /**
     * Get module repository
     *
     * @return Repository
     */
    public function getRepository() : Repository;
}