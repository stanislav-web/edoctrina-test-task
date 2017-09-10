<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\Aware\AbstractDataMapper;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Db\Exception\StorageException;
use Quiz\Modules\Question\Entities\AbstractEntity;
use Quiz\Modules\Question\Entities\Question;

/**
 * Class QuestionDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class QuestionDataMapper extends AbstractDataMapper {

    /**
     * @const TABLE
     */
    const TABLE = 'questions';

    /**
     * Add row
     *
     * @param int $quizId
     * @param string $title
     *
     * @throws DataManagerException
     * @return Question
     */
    public function addRow(int $quizId, $title): Question {

        try {
            $query = 'INSERT INTO  ' .self::TABLE. ' (`quiz_id`,`title`) VALUES (
                        :quiz_id, 
                        :title
                    )';

            $rowId = $this->db->insert($query, [
                'quiz_id' => $quizId,
                'title' => $title,
            ]);
            return $this->findById($rowId);

        } catch (StorageException $e) {
            throw new DataManagerException('Quiz does not added');
        }
    }

    /**
     * Find row by id
     *
     * @param int $id
     *
     * @throws DataManagerException
     * @return Question
     */
    public function findById(int $id): Question {

        $query = 'SELECT `id`, `quiz_id`, `title`, `status`
                    FROM ' .self::TABLE. ' 
                    WHERE id = :id';

        $result = $this->db->fetch($query, ['id' => $id]);

        if (null === $result) {
            throw new DataManagerException('Question not found');
        }

        return $this->mapRow($result);
    }

    /**
     * Find row by quiz id
     *
     * @param int $quizId
     *
     * @throws DataManagerException
     * @return Question[]|array
     */
    public function findByQuizId(int $quizId): array {

        $query = 'SELECT `id`, `quiz_id`, `title`, `status`
                    FROM ' .self::TABLE. ' 
                    WHERE quiz_id = :quiz_id';

        $result = $this->db->fetchAll($query, ['quiz_id' => $quizId]);

        if (null === $result) {
            throw new DataManagerException('Questions not found');
        }

        return $this->mapRows($result);
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
            $query = 'DELETE FROM ' .self::TABLE. '
                        WHERE `id` = :id';

            return $this->db->delete($query, ['id' => $id]);

        } catch (StorageException $e) {
            throw new DataManagerException('Question #'.$id.' doesn not removed');
        }
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return Question
     */
    protected function mapRow(array $row) {

        try {
            $question = new Question();
            $question->setFromArray($row);
            return $question;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}