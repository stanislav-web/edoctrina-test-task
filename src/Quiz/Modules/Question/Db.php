<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\Db\Exception\StorageException;
use Quiz\Modules\Question\Db\MySQLTransaction;

/**
 * Class Db
 * @package Quiz\Modules\Question
 */
class Db extends AbstractDatabase {

    use MySQLTransaction;

    /**
     * Fetch all rows
     *
     * @param string $query
     * @param array $params
     * @throws StorageException
     *
     * @return array
     */
    public function fetchAll($query, array $params = null): array {

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetchAll();
            return $result ?: [];

        } catch (\PDOException $e) {
            throw new StorageException($e);
        }

    }

    /**
     * Fetch row
     *
     * @param string $query
     * @param array    $params
     * @throws StorageException
     *
     * @return array
     */
    public function fetch($query, array $params) : array {

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetch();
            return $result ?: [];

        } catch (\PDOException $e) {
            throw new StorageException($e);
        }
    }

    /**
     * Insert row query
     *
     * @param string $query
     * @param array $params
     * @throws StorageException
     *
     * @return int
     */
    public function insert($query, array $params) : int {

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $this->db->lastInsertId();

        } catch (\PDOException $e) {
            throw new StorageException($e);
        }
    }

    /**
     * Update row query
     *
     * @param string $query
     * @param array $params
     * @throws StorageException
     *
     * @return bool
     */
    public function update($query, array $params) : bool {

        try {

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);

        } catch (\PDOException $e) {
            throw new StorageException($e);
        }
    }

    /**
     * Delete row query
     *
     * @param string $query
     * @param array $params
     * @throws StorageException
     *
     * @return bool
     */
    public function delete($query, array $params) : bool {

        try {

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);

        } catch (\PDOException $e) {
            throw new StorageException($e);
        }
    }

}