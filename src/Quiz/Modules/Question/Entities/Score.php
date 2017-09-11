<?php
namespace Quiz\Modules\Question\Entities;

/**
 * Class Score
 * @package Quiz\Modules\Question\Entities
 */
class Score extends AbstractEntity {

    /**
     * Quiz id
     *
     * @var int $quiz_id
     */
    public $quiz_id;

    /**
     * Question id
     *
     * @var int $question_id
     */
    public $question_id;

    /**
     * Answer
     *
     * @var int $answer
     */
    public $answer;
    /**
     * Status
     *
     * @var string $status
     */
    public $status;
}