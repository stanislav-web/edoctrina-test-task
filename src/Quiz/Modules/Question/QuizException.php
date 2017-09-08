<?php
namespace Quiz\Modules\Question;

/**
 * Class QuizException
 * @package Quiz\Modules\Question
 */
class QuizException extends \Exception
{
    const CODE = 400;

    /**
     * QuizException constructor.
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