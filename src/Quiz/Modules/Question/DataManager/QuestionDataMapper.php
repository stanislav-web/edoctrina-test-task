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
     * @return Question
     */
    public function findById(int $id): Question
    {
        $query = 'SELECT `id`, `quiz_id`, `description`, `status` 
                    FROM ' .self::TABLE. ' 
                    WHERE id = :id';

        $result = $this->db->fetchById($query, $id);

        if (null === $result) {
            throw new DataManagerException('Question #'.$id.' not found');
        }

        return $this->mapRow($result);
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
}