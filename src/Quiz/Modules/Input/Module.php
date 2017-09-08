<?php
namespace  Quiz\Modules\Input;

use Quiz\Modules\Input\Entities\GetVars;
use Quiz\Modules\Input\Entities\PostVars;

/**
 * Class Module
 * @package Quiz\Module\Input
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
     * @throws InputException
     *
     * @return RepositoryInterface
     */
    public function getRepository() : RepositoryInterface {

        if(false === in_array($_SERVER['REQUEST_METHOD'], $this->getConfig()->allow_methods, true)) {
            throw new InputException($_SERVER['REQUEST_METHOD'] .' method is not allowed');
        }

        if(null === $this->repository) {
            $moduleService = new ModuleService(
                new GetVars(),
                new PostVars()
            );

            $this->repository = new Repository($moduleService);
        }

        return $this->repository;
    }
}