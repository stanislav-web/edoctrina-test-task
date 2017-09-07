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
     * @param ValueObject $valueObject
     */
    public function __construct(ValueObject $valueObject) {
        $this->getEntity = $valueObject->getVars();
        $this->postEntity = $valueObject->postVars();
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
}