<?php
namespace Quiz\Modules\Question\Entities;

/**
 * Class ScoreResult
 * @package Quiz\Modules\Question\Entities
 */
class ScoreResult extends AbstractEntity {

    /**
     * Quiz id
     *
     * @var int $quiz_id
     */
    public $quiz_id;

    /**
     * Ok status
     *
     * @var int $ok
     */
    public $ok;

    /**
     * Failed status
     *
     * @var int $failed
     */
    public $failed;

    /**
     * Total
     *
     * @var int $total
     */
    public $total;
}