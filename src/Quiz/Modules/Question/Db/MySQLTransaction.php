<?php
namespace Quiz\Modules\Question\Db;

/**
 * Class MySQLTransaction
 * @package Quiz\Modules\Question\Db
 */
trait MySQLTransaction  {

    /**
     * Transaction counter
     *
     * @var int $transactionCounter
     */
    protected $transactionCounter = 0;

    /**
     * Start transaction if another has no placed yet
     *
     * @return bool
     */
    public function begin() : bool {

        if (!$this->transactionCounter++) {
            $this->db->beginTransaction();
        }

        return $this->transactionCounter >= 0;
    }

    /**
     * Commit transaction if another has no started
     *
     * @return bool
     */
    public function commit() : bool {

        if (!--$this->transactionCounter) {
            return $this->db->commit();
        }
        return $this->transactionCounter >= 0;
    }

    /**
     * Rollback transaction if another has no started yet
     *
     * @return bool
     */
    public function rollback() : bool {
        if (--$this->transactionCounter) {
            return true;
        }
        return $this->db->rollBack();
    }
}