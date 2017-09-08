<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\Db\Exception\StorageException;

/**
 * Class Db
 * @package Quiz\Modules\Question
 */
class Db extends AbstractDatabase {

    /**
     * Fetch all rows
     *
     * @param string $query
     * @throws StorageException
     *
     * @return array
     */
    public function fetchAll($query): array {

        try {
            $res = $this->db->query($query);
            return $res->fetchAll();
        } catch (\PDOException $e) {
            throw new StorageException($e);
        }

    }

    /**
     * Fetch row(s) by id
     *
     * @param string $query
     * @param int    $id
     * @throws StorageException
     *
     * @return array
     */
    public function fetchById($query, $id) : array {

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
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