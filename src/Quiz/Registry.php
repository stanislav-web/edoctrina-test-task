<?php

namespace Quiz;

/**
 * Class Registry
 * @package Quiz\Application
 */
final class Registry Implements \ArrayAccess
{
    /**
     * @var array $vars
     */
    private $vars = [];

    /**
     * @param string $key
     * @param mixed $var
     *
     * @throws \InvalidArgumentException
     *
     * @return Registry
     */
    private function set($key, $var) : Registry {

        if (true === isset($this->vars[$key])) {
            throw new \InvalidArgumentException('Unable to set var `' . $key . '`. Already set.');
        }
        $this->vars[$key] = $var;

        return $this;

    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    private function get($key) {

        if (false === isset($this->vars[$key])) {
            return null;
        }
        return $this->vars[$key];
    }

    /**
     * @param string $var
     *
     * @return Registry
     */
    private function remove($var) : Registry {
        unset($this->vars[$var]);

        return $this;
    }

    /**
     * Check value for existence
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset) : bool {
        return isset($this->vars[$offset]);
    }

    /**
     * Get value from registry
     *
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset) {
        return $this->get($offset);
    }

    /**
     * Set value to registry
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function offsetSet($offset, $value) : bool {
        $this->set($offset, $value);

        return true;
    }

    /**
     * Unset value from registry
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetUnset($offset) : bool {
        $this->remove($offset);

        return true;
    }


}