<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\Aware\AbstractDataMapper;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Db\Exception\StorageException;
use Quiz\Modules\Question\Entities\Quiz;

/**
 * Class QuizDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class QuizDataMapper extends AbstractDataMapper {

    /**
     * @const QUIZ_TABLE
     */
    const QUIZ_TABLE = 'quizzes';

    /**
     * @const QUESTIONS_TABLE
     */
    const QUESTIONS_TABLE = 'questions';

    /**
     * Find all rows
     *
     * @return array
     * @throws DataManagerException
     */
    public function findAll(): array {

        $query = 'SELECT qz.`id`, qz.`name`, qz.`description`, qz.`status`, COUNT(qs.`id`) as `count`
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

        $query = 'SELECT qz.`id`, qz.`name`, qz.`description`, qz.`status`, COUNT(qs.`id`) as `count`
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
     * @param string $name
     * @param string $description
     *
     * @throws DataManagerException
     * @return Quiz
     */
    public function addRow($name, $description): Quiz {

        try {
            $query = 'INSERT INTO  ' .self::QUIZ_TABLE. ' (`name`,`description`) VALUES (
                        :name, 
                        :description
                    )';

            $rowId = $this->db->insert($query, [
                    'name' => $name,
                    'description' => $description,
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
    protected function mapRow(array $row) {

        try {
            $quiz = new Quiz();
            $quiz->setFromArray($row);
            return $quiz;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}