<?php
namespace Quiz\Modules\Question\Aware;

/**
 * Interface TransactInterface
 * @package Quiz\Modules\Question\Aware
 */
interface TransactInterface {

    /**
     * Start transaction if another has no placed yet
     *
     * @return bool
     */
    public function begin() : bool;

    /**
     * Commit transaction if another has no started
     *
     * @return bool
     */
    public function commit() : bool;

    /**
     * Rollback transaction if another has no started yet
     *
     * @return bool
     */
    public function rollback() : bool;
}