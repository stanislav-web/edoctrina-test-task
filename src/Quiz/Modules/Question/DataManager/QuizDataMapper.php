<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Entities\Quiz;

/**
 * Class QuizDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class QuizDataMapper {

    /**
     * @const TABLE
     */
    const TABLE = 'quiz';

    /**
     * @var AbstractDatabase $db
     */
    private $db;

    /**
     * QuizDataMapper constructor.
     *
     * @param AbstractDatabase $db
     */
    public function __construct(AbstractDatabase $db) {
        $this->db = $db;
    }

    /**
     * Find all rows
     *
     * @throws DataManagerException
     * @return array
     */
    public function findAll(): array
    {
        $query = 'SELECT `id`, `name`, `count` 
                    FROM ' .self::TABLE;

        $result = $this->db->fetchAll($query);

        if (null === $result) {
            throw new DataManagerException('Quiz are not available');
        }

        return $this->mapRows($result);
    }

    /**
     * Find row by id
     *
     * @param int $id
     *
     * @throws DataManagerException
     * @return Quiz
     */
    public function findById(int $id): Quiz
    {
        $query = 'SELECT `id`, `name`, `count` 
                    FROM ' .self::TABLE. ' 
                    WHERE id = :id';

        $result = $this->db->fetchById($query, $id);

        if (null === $result) {
            throw new DataManagerException('Quiz #'.$id.' not found');
        }

        return $this->mapRow($result);
    }

    /**
     * Add row
     *
     * @param array $param
     *
     * @throws DataManagerException
     * @return Quiz
     */
    public function addRow(array $param): Quiz {

        $query = 'INSERT INTO  ' .self::TABLE. ' (`name`, `count`) VALUES (
                        :name, 
                        :count
                    )';
        $rowId = $this->db->insert($query, ['name' => $param['name'], 'count' => $param['count']]);
        $result = $this->findById($rowId);

        if (null === $result) {
            throw new DataManagerException('Quiz doesn not added');
        }

        return $result;
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return Quiz
     */
    private function mapRow(array $row): Quiz {

        try {
            $quiz = new Quiz();
            $quiz->setFromArray($row);
            return $quiz;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }

    /**
     * Mapping data from rows to object
     *
     * @param array $rows
     * @throws DataManagerException
     *
     * @return Quiz[]|array
     */
    private function mapRows(array $rows): array {

        $result = [];

        try {
            foreach($rows as $row) {
                $result[] = $this->mapRow($row);
            }

            return $result;

        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}