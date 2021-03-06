<?php
namespace Quiz\Modules\Question\Entities;

/**
 * Class Question
 * @package Quiz\Modules\Question\Entities
 */
class Question extends AbstractEntity {

    /**
     * Question id
     *
     * @var int $id
     */
    public $id;

    /**
     * Quiz id
     *
     * @var int $quiz_id
     */
    public $quiz_id;

    /**
     * Question title
     *
     * @var string $title
     */
    public $title;

    /**
     * Question status
     *
     * @var string $status
     */
    public $status;
}