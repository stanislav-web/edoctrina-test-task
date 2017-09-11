<?php
namespace Quiz\Exceptions;

/**
 * Class RouterException
 * @package Quiz\Exceptions
 */
class RouterException extends \RuntimeException
{
    const CODE = 404;

    /**
     * RouterException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message, $code = self::CODE, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}