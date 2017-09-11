<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDataMapper;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Entities\Score;
use Quiz\Modules\Question\Entities\ScoreResult;

/**
 * Class ScoreDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class ScoreDataMapper extends AbstractDataMapper {

    /**
     * @const TABLE
     */
    const TABLE = 'score';

    /**
     * Find row by quiz_id
     *
     * @param int $quiz_id
     *
     * @throws DataManagerException
     *
     * @return Score[]|array
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function findByQuizId(int $quiz_id): array {

        $query = 'SELECT `quiz_id`, `question_id`, `answer`, `status`
                    FROM ' .self::TABLE.'
                    WHERE `quiz_id` = :quiz_id';

        $result = $this->db->fetchAll($query, [':quiz_id' => $quiz_id]);

        if (null === $result) {
            throw new DataManagerException('Score for #'.$quiz_id.' not found');
        }

        return $this->mapRows($result);
    }

    /**
     * Count score by quiz id
     *
     * @param int $quiz_id
     *
     * @throws DataManagerException
     *
     * @return ScoreResult
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function scoreByQuizId(int $quiz_id) : ScoreResult {

        $query = 'SELECT `quiz_id`,
                    SUM(CASE WHEN `status` = \'ok\' THEN 1 ELSE 0 END) as `ok`,
                    SUM(CASE WHEN status = \'fail\' THEN 1 ELSE 0 END) as `failed`,
                    COUNT(`quiz_id`) as `total`
                        FROM '.self::TABLE.'
                        WHERE quiz_id = :quiz_id';

        $result = $this->db->fetch($query, [':quiz_id' => $quiz_id]);

        if (null === $result) {
            throw new DataManagerException('Score for #'.$quiz_id.' not found');
        }
        return $this->mapScoreResultRow($result);
    }

    /**
     * Add row
     * @param int $quiz_id
     * @param int $question_id
     * @param int $answer
     * @param     $status
     *
     * @return int
     * @throws DataManagerException
     */
    public function addRow(int $quiz_id, int $question_id, $answer, $status): int {

        try {
            $query = 'INSERT INTO  ' .self::TABLE. ' (`quiz_id`, `question_id`, `answer`,`status`) VALUES (
                        :quiz_id, 
                        :question_id, 
                        :answer, 
                        :status
                    )';

            $rowId = $this->db->insert($query, [
                'quiz_id' => $quiz_id,
                'question_id' => $question_id,
                'answer' => $answer,
                'status' => $status,
            ]);

            return $rowId;

        } catch (\Throwable $e) {
            var_dump($e);
            throw new DataManagerException('Score does not added');
        }
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return Score
     */
    protected function mapRow(array $row) : Score {

        try {
            $score = new Score();
            $score->setFromArray($row);
            return $score;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return ScoreResult
     */
    protected function mapScoreResultRow(array $row) : ScoreResult {

        try {
            $score = new ScoreResult();
            $score->setFromArray($row);
            return $score;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}