<?php
namespace Quiz\Modules\Input;

/**
 * Interface RepositoryInterface
 * @package Quiz\Modules\Input
 */
interface RepositoryInterface {

    /**
     * Get "GET" data from request
     *
     * @param string $name
     * @return mixed
     */
    public function get($name = null);

    /**
     * Get "GET" data from request
     *
     * @param string $name
     * @return mixed
     */
    public function post($name = null);

}