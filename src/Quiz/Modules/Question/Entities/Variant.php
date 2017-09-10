<?php
namespace Quiz\Modules\Question\Entities;

/**
 * Class Varaiant
 * @package Quiz\Modules\Question\Entities
 */
class Variant extends AbstractEntity {

    /**
     * Variant id
     *
     * @var int $id
     */
    public $id;

    /**
     * Question id
     *
     * @var int $question_id
     */
    public $question_id;

    /**
     * Variant title
     *
     * @var string $title
     */
    public $title;

    /**
     * Variant right flag
     *
     * @var string $right
     */
    public $right;
}