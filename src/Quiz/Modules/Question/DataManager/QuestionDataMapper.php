<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Entities\Question;

/**
 * Class QuestionDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class QuestionDataMapper {

    /**
     * @const TABLE
     */
    const TABLE = 'questions';

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
     * Find row by id
     *
     * @param int $id
     *
     * @throws DataManagerException
     * @return Question[]|array
     */
    public function findByQuizId(int $quizId): array {

        $query = 'SELECT `id`, `quiz_id`, `description`, `status` 
                    FROM ' .self::TABLE. ' 
                    WHERE quiz_id = :quiz_id';

        $result = $this->db->fetchAll($query, ['quiz_id' => $quizId]);

        if (null === $result) {
            throw new DataManagerException('Questions not found');
        }

        return $this->mapRows($result);
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return Question
     */
    private function mapRow(array $row): Question {

        try {
            $question = new Question();
            $question->setFromArray($row);
            return $question;
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
     * @return Question[]|array
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