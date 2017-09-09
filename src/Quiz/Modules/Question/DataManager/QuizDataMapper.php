<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Db\Exception\StorageException;
use Quiz\Modules\Question\Entities\Quiz;

/**
 * Class QuizDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class QuizDataMapper {

    /**
     * @const QUIZ_TABLE
     */
    const QUIZ_TABLE = 'quizzes';

    /**
     * @const QUESTIONS_TABLE
     */
    const QUESTIONS_TABLE = 'questions';

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
     * @return array
     * @throws DataManagerException
     */
    public function findAll(): array {

        $query = 'SELECT qz.`id`, qz.`name`, qz.`description`, COUNT(qs.`id`) as `count`
                    FROM ' .self::QUIZ_TABLE.' qz
                    LEFT JOIN '.self::QUESTIONS_TABLE.' qs ON (qs.quiz_id = qz.id) 
                    GROUP BY qz.id';

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
    public function findById(int $id): Quiz {

        $query = 'SELECT qz.`id`, qz.`name`, qz.`description`, COUNT(qs.`id`) as `count`
                    FROM ' .self::QUIZ_TABLE.' qz
                    LEFT JOIN '.self::QUESTIONS_TABLE.' qs ON (qs.quiz_id = qz.id) 
                    WHERE qz.`id` = :id';

        $result = $this->db->fetch($query, [':id' => $id]);

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

        try {
            $query = 'INSERT INTO  ' .self::QUIZ_TABLE. ' (`name`,`description`) VALUES (
                        :name, 
                        :description
                    )';

            $rowId = $this->db->insert($query, [
                    'name' => $param['name'],
                    'description' => $param['description'],
            ]);
            return $this->findById($rowId);

        } catch (StorageException $e) {
            throw new DataManagerException('Quiz does not added');
        }
    }

    /**
     * Remove row
     *
     * @param int $id
     *
     * @throws DataManagerException
     * @return bool
     */
    public function removeRow(int $id): bool {

        try {
            $query = 'DELETE FROM ' .self::QUIZ_TABLE. '
                        WHERE `id` = :id';

            return $this->db->delete($query, ['id' => $id]);

        } catch (StorageException $e) {
            throw new DataManagerException('Quiz #'.$id.' doesn not removed');
        }
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