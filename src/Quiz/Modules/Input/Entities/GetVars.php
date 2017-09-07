<?php
namespace Quiz\Modules\Input\Entities;

/**
 * Class GetVars
 *
 * @package Quiz\Modules\Input\Entities
 */
class GetVars extends AbstractEntity {

    /**
     * @var array $vars
     */
    public $vars = [];

    /**
     * Fill object property from array
     *
     * @param array $data
     *
     * @return AbstractEntity
     */
    public function setFromArray(array $data): AbstractEntity {

        foreach ($data as $property => $value) {

            $value = filter_input(INPUT_GET, $property, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->vars[$property] = $value;
        }
        return $this;
    }
}