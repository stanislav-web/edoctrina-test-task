<?php
namespace  Quiz\Modules\Question;

/**
 * Class Module
 * @package Quiz\Module\Question
 */
class Module implements ModuleInterface {

    /**
     * @var Repository $repository
     */
    private $repository;

    /**
     * Set module repository
     *
     * @param Repository $repository
     *
     * @return ModuleInterface
     */
    public function setRepository(Repository $repository) : ModuleInterface {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Get module repository
     *
     * @return Repository
     */
    public function getRepository() : Repository {
        return $this->repository;
    }
}