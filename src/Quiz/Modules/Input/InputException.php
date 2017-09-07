<?php
namespace Quiz\Modules\Input;

/**
 * Class InputException
 * @package Quiz\Modules\Input
 */
class InputException extends \Exception
{
    const CODE = 400;

    /**
     * ViewException constructor.
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