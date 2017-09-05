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
     * @return Repository
     */
    public function getRepository() : Repository {

        if(null === $this->repository) {

            $valueObject = new ValueObject(new Meta(), new View());
            $this->repository = new Repository($this->getConfig(), $valueObject);
        }

        return $this->repository;
    }
}