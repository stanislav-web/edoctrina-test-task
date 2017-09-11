<?php

namespace Quiz\Modules\Question\Db\Exception;

/**
 * Class StorageException
 * @package Quiz\Modules\Question\Db\Exception
 */
class StorageException extends \Exception {

    const CODE = 500;

    /**
     * StorageException constructor.
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