<?php
namespace Quiz\Modules\Question;

/**
 * Interface RepositoryInterface
 * @package Quiz\Modules\Question
 */
interface RepositoryInterface {

    /**
     * Load `ModuleService`
     *
     * @return ModuleService
     */
    public function loadModlueService() : ModuleService;
}