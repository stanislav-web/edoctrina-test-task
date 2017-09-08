<?php
namespace Quiz\Modules\Question\Entities;

/**
 * Class AbstractEntity
 * @package Quiz\Modules\Question\Entities
 */
abstract class AbstractEntity {

    /**
     * @param string $property
     *
     * @throws \InvalidArgumentException
     */
    public function __get($property) {
        throw new \InvalidArgumentException($property.' does not exist');
    }

    /**
     * @param string $property
     *
     * @throws \InvalidArgumentException
     */
    public function __isset($property) {
        throw new \InvalidArgumentException($property.' does not exist');
    }

    /**
     * @param string $property
     * @param mixed  $value
     *
     * @throws \InvalidArgumentException
     */
    public function __set($property, $value) {
        throw new \InvalidArgumentException($property.' property does not support for this Entity');
    }

    /**
     * Fill object property from array
     *
     * @param array $data
     *
     * @return AbstractEntity
     */
    public function setFromArray(array $data): AbstractEntity {

        foreach ($data as $property => $value) {
            $this->$property = (true === is_numeric($value)) ? (int)$value : $value;
        }
        return $this;
    }
}