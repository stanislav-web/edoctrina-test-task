<?php
namespace Quiz\Modules\Input;

use Quiz\Modules\Input\Entities\AbstractEntity;

/**
 * Class Repository
 * @package Quiz\Modules\Input
 */
class Repository implements RepositoryInterface {

    /**
     * @var AbstractEntity $getEntity
     */
    private $getEntity;

    /**
     * @var AbstractEntity $postEntity
     */
    private $postEntity;

    /**
     * Repository constructor.
     *
     * @param ModuleService $moduleService
     */
    public function __construct(ModuleService $moduleService) {
        $this->getEntity = $moduleService->getVars();
        $this->postEntity = $moduleService->postVars();
    }

    /**
     * Get "GET" data from request
     *
     * @param string $name
     * @return mixed
     */
    public function get($name = null) {
        $input = $this->getEntity->setFromArray($_GET);
        return $input->vars[$name] ?? $input->vars;
    }

    /**
     * Get "POST" data from request
     *
     * @param string $name
     * @return mixed
     */
    public function post($name = null) {
        $input = $this->postEntity->setFromArray($_POST);
        return $input->vars[$name] ?? $input->vars;
    }

    /**
     * If request is GET
     *
     * @return bool
     */
    public function isGet() : bool {
        return 'GET' === $_SERVER['REQUEST_METHOD'];
    }

    /**
     * if request is POST
     *
     * @return bool
     */
    public function isPost() : bool {
        return 'POST' === $_SERVER['REQUEST_METHOD'];
    }
}