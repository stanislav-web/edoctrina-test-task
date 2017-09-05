<?php
namespace Quiz\Modules\View;

use Quiz\Modules\View\Entities\Meta;

/**
 * Interface RepositoryInterface
 * @package Quiz\Modules\View
 */
interface RepositoryInterface {

    /**
     * Set meta data from array
     *
     * @param array $param
     *
     * @return RepositoryInterface
     */
    public function setMetaData(array $param) : RepositoryInterface;

    /**
     * Get meta data
     *
     * @return Meta
     */
    public function getMetaData() : Meta;

    /**
     * Set layout
     *
     * @param string $layout
     * @return RepositoryInterface
     */
    public function setLayout($layout) : RepositoryInterface;

    /**
     * Render view
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     * @throws ViewException
     */
    public function render($template, array $data = []) : string;
}