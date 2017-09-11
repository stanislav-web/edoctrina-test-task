<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDataMapper;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Db\Exception\StorageException;
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
                'title' => trim($title),
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
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
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
     * Count total questions
     *
     * @param int $quiz_id
     *
     * @throws DataManagerException
     * @return int
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function countTotal(int $quiz_id): int {

        $query = 'SELECT COUNT(`id`) as `count`
                    FROM ' .self::TABLE. ' 
                    WHERE quiz_id = :quiz_id';

        $result = $this->db->fetch($query, ['quiz_id' => $quiz_id]);

        if (null === $result) {
            throw new DataManagerException('Calculate does not executed');
        }

        return $result['count'];
    }

    /**
     * Count  questions by status
     *
     * @param int    $quiz_id
     * @param string $status
     *
     * @throws DataManagerException
     * @return int
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function countQuestionsByStatus(int $quiz_id, $status): int {

        $query = 'SELECT COUNT(`id`) as `count`
                    FROM ' .self::TABLE. ' 
                    WHERE quiz_id = :quiz_id AND status = :status';

        $result = $this->db->fetch($query, [
            'quiz_id' => $quiz_id,
            'status'  => $status
        ]);

        if (null === $result) {
            throw new DataManagerException('Calculate does not executed');
        }

        return $result['count'];
    }

    /**
     * Find row by quiz id
     *
     * @param int $quizId
     *
     * @throws DataManagerException
     * @return Question[]|array
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
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
     * Find row by quiz id
     *
     * @param int    $quizId
     * @param string $status
     *
     * @throws DataManagerException
     * @return Question
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function findRandomOneByQuizId(int $quizId, $status): Question {

        // ORDER BY RAND()
        // This expresion will not be a problem for such system, so that it has a place to live
        $query = 'SELECT `id`, `quiz_id`, `title`, `status`
                    FROM ' .self::TABLE. ' 
                    WHERE `quiz_id` = :quiz_id AND `status` = :status
                    ORDER BY RAND()';

        $result = $this->db->fetch($query, ['quiz_id' => $quizId, 'status' => $status]);

        if (null === $result) {
            throw new DataManagerException('Questions not found');
        }

        return $this->mapRow($result);
    }

    /**
     * Update row
     *
     * @param int $id
     * @param string $status
     *
     * @throws DataManagerException
     * @return bool
     */
    public function updateStatusRow(int $id, $status): bool {

        try {
            $query = 'UPDATE ' .self::TABLE. '
                        SET `status` = :status
                         WHERE `id` = :id';

            return $this->db->update($query, ['id' => $id, 'status' => $status]);

        } catch (StorageException $e) {
            throw new DataManagerException('Question #'.$id.' status doesn not updated');
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
    protected function mapRow(array $row) : Question {

        try {
            $question = new Question();
            $question->setFromArray($row);
            return $question;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}