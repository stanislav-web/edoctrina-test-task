<?php
namespace Quiz\Modules\Question\Entities;

/**
 * Class Quiz
 * @package Quiz\Modules\Question\Entities
 */
class Quiz extends AbstractEntity {

    /**
     * Quiz id
     *
     * @var int $id
     */
    public $id;

    /**
     * Quiz name
     *
     * @var string $name
     */
    public $name;


    /**
     * Quiz counter
     *
     * @var string $count
     */
    public $count;

}