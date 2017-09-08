<?php
namespace Quiz\Modules\Question\Aware;

use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
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
     * @throws DataManagerException
     *
     * @return array
     */
    abstract public function fetchAll($query) : array;

    /**
     * Fetch row(s) by id
     *
     * @param string $query
     * @param int    $paramId
     * @throws DataManagerException
     *
     * @return array
     */
    abstract public function fetchById($query, $paramId) : array;

}