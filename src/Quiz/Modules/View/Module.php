<?php
namespace  Quiz\Modules\View;

use Quiz\Modules\View\Entities\View;
use Quiz\Modules\View\Entities\Meta;

/**
 * Class Module
 * @package Quiz\Module\View
 */
class Module implements ModuleInterface {

    /**
     * @var RepositoryInterface $repository
     */
    private $repository;

    /**
     * Get module config
     *
     * @return \stdClass
     */
    public function getConfig(): \stdClass {
        return (object)include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get "lazy" module repository
     *
     * @return RepositoryInterface
     */
    public function getRepository() : RepositoryInterface {

        if(null === $this->repository) {

            $quizModuleService = new ModuleService(new Meta(), new View());
            $this->repository = new Repository($this->getConfig(), $quizModuleService);
        }

        return $this->repository;
    }
}