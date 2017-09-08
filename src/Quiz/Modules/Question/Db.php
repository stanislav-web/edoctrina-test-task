<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;

/**
 * Class Db
 * @package Quiz\Modules\Question
 */
class Db extends AbstractDatabase {

    /**
     * Fetch all rows
     *
     * @param string $query
     * @throws DataManagerException
     *
     * @return array
     */
    public function fetchAll($query): array {

        try {
            $res = $this->db->query($query);
            return $res->fetchAll();
        } catch (\PDOException $e) {
            throw new DataManagerException($e);
        }

    }

    /**
     * Fetch row(s) by id
     *
     * @param string $query
     * @param int    $id
     * @throws DataManagerException
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
            throw new DataManagerException($e);
        }
    }
}