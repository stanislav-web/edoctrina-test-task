<?php
namespace Quiz\Modules\Question\Aware;

use Quiz\Modules\Question\Db\Exception\StorageException;
use Quiz\Modules\Question\Db\Exception\MySQLStorageException;

/**
 * Class AbstractDatabase
 * @package Quiz\Modules\Question\Aware
 */
abstract class AbstractDatabase {

    /**
     * @var DbAdapterInterface $db
     */
    protected $db;

    /**
     * AbstractDatabase constructor.
     *
     * @param DbAdapterInterface $db
     *
     * @throws MySQLStorageException
     */
    public function __construct(DbAdapterInterface $db) {
        $this->db = $db->connect();
    }

    /**
     * Fetch all rows
     *
     * @param string $query
     * @throws StorageException
     *
     * @return array
     */
    abstract public function fetchAll($query) : array;

    /**
     * Fetch row(s) by id
     *
     * @param string $query
     * @param int    $paramId
     * @throws StorageException
     *
     * @return array
     */
    abstract public function fetchById($query, $paramId) : array;

    /**
     * Insert row query
     *
     * @param string $query
     * @param array $params
     * @throws StorageException
     *
     * @return int
     */
    abstract public function insert($query, array $params) : int;

    /**
     * Delete row query
     *
     * @param string $query
     * @param array $params
     * @throws StorageException
     *
     * @return bool
     */
    abstract public function delete($query, array $params) : bool;

}