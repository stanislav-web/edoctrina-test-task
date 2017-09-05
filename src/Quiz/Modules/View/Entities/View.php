<?php
namespace Quiz\Modules\View\Entities;

/**
 * Class View
 * @package Quiz\Modules\View\Entities
 */
class View extends AbstractEntity {

    /**
     * @var string $layout
     */
    public $layout;

    /**
     * @var string $template
     */
    public $template;

    /**
     * @var array $vars
     */
    public $vars = [];

    /**
     * Get variable
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name) {
        return $this->vars[$name];
    }

    /**
     * Set variable
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value) {
        print $value;
        $this->vars[$name] = $value;
    }
}