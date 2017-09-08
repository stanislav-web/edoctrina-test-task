<?php
namespace Quiz\Modules\Question;

/**
 * Class Repository
 * @package Quiz\Modules\Question
 */
class Repository implements RepositoryInterface {

    /**
     * @var ModuleService $moduleService
     */
    private $moduleService;

    /**
     * Repository constructor.
     *
     * @param ModuleService $moduleService
     */
    public function __construct(ModuleService $moduleService) {
        $this->moduleService = $moduleService;
    }

    /**
     * Load `ModuleService`
     *
     * @return ModuleService
     */
    public function loadModlueService() : ModuleService {
        return $this->moduleService;
    }
}