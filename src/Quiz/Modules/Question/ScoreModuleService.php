<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\DataManager\QuestionDataMapper;
use Quiz\Modules\Question\DataManager\ScoreDataMapper;
use Quiz\Modules\Question\DataManager\VariantDataMapper;
use Quiz\Modules\Question\Entities\Score;
use Quiz\Modules\Question\Entities\ScoreResult;

/**
 * Class ScoreModuleService
 * @package Quiz\Modules\Question
 */
class ScoreModuleService {

    /**
     * @cost STATUS_OK
     * @cost STATUS_FAIL
     * @cost STATUS_DONE
     */
    const STATUS_OK     = 'ok';
    const STATUS_FAIL     = 'fail';
    const STATUS_DONE   = 'done';

    /**
     * @var ScoreDataMapper $scoreDataMapper
     */
    private $scoreDataMapper;

    /**
     * @var QuestionDataMapper $questionDataMapper
     */
    private $questionDataMapper;

    /**
     * @var VariantDataMapper $variantDataMapper
     */
    private $variantDataMapper;

    /**
     * ScoreModuleService constructor.
     *
     * @param ScoreDataMapper $scoreDataMapper
     * @param QuestionDataMapper $questionDataMapper
     * @param VariantDataMapper $variantDataMapper
     */
    public function __construct(
        ScoreDataMapper $scoreDataMapper,
        QuestionDataMapper $questionDataMapper,
        VariantDataMapper $variantDataMapper
    ) {
        $this->scoreDataMapper = $scoreDataMapper;
        $this->questionDataMapper = $questionDataMapper;
        $this->variantDataMapper = $variantDataMapper;
    }

    /**
     * Add result
     *
     * @param int $quiz_id
     * @param int $question_id
     * @param int $answer
     *
     * @return int
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     * @throws QuizException
     */
    public function addResultRow(int $quiz_id, int $question_id, int $answer): int {

        try {

            $this->scoreDataMapper->beginTransaction();
            $variant = $this->variantDataMapper->findByQuestionVariantId($question_id, $answer);
            $status = $variant->right ? self::STATUS_OK : self::STATUS_FAIL;
            $scoreStatus = $this->scoreDataMapper->addRow($quiz_id, $question_id, $variant->id, $status);
            $this->questionDataMapper->updateStatusRow($question_id, self::STATUS_DONE);
            $this->scoreDataMapper->commitTransaction();

            return $scoreStatus;

        } catch (DataManagerException $e) {
            $this->scoreDataMapper->rollbackTransaction();
            throw new QuizException($e);
        }
    }

    /**
     * Get score result
     *
     * @param int $quiz_id
     *
     * @throws QuizException
     *
     * @return Score[]|array
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function getQuizScore(int $quiz_id) : array {

        try {
            $collection = [];
            $scoreArray = $this->scoreDataMapper->findByQuizId($quiz_id);
            foreach ($scoreArray as $score) {
                $collection[$score->question_id] = $score;
            }

            return $collection;
        } catch (DataManagerException $e) {
            $this->scoreDataMapper->rollbackTransaction();
            throw new QuizException($e);
        }
    }

    /**
     * Get score result
     *
     * @param int $quiz_id
     *
     * @throws QuizException
     *
     * @return ScoreResult
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function getQuizScoreResult(int $quiz_id) : ScoreResult {

        try {
            return $this->scoreDataMapper->scoreByQuizId($quiz_id);

        } catch (DataManagerException $e) {
            $this->scoreDataMapper->rollbackTransaction();
            throw new QuizException($e);
        }
    }
}