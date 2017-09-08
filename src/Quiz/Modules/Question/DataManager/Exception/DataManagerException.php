<?php

namespace Quiz\Modules\Question\DataManager\Exception;

/**
 * Class DataManagerException
 * @package Quiz\Modules\Question\DataManager\Exception
 */
class DataManagerException extends \Exception {

    const CODE = 500;

    /**
     * StorageException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = self::CODE, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}