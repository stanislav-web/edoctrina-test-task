<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\DataManager\QuestionDataMapper;
use Quiz\Modules\Question\DataManager\VariantDataMapper;
use Quiz\Modules\Question\DTO\QuestionsDataTransferObject;

/**
 * Class QuestionModuleService
 * @package Quiz\Modules\Question
 */
class QuestionModuleService {

    /**
     * @cost STATUS_PENDING
     * @cost STATUS_PROGRESS
     * @cost STATUS_DONE
     */
    const STATUS_PENDING  = 'pending';
    const STATUS_PROGRESS = 'progress';
    const STATUS_DONE     = 'done';

    /**
     * @var QuestionDataMapper $questionDataMapper
     */
    private $questionDataMapper;

    /**
     * @var VariantDataMapper $variantDataMapper
     */
    private $variantDataMapper;


    /**
     * QuestionModuleService constructor.
     *
     * @param QuestionDataMapper $questionDataMapper
     * @param VariantDataMapper  $variantDataMapper
     */
    public function __construct(
        QuestionDataMapper $questionDataMapper,
        VariantDataMapper $variantDataMapper) {
        $this->questionDataMapper = $questionDataMapper;
        $this->variantDataMapper = $variantDataMapper;
    }

    /**
     * Get all questions
     *
     * @param int $quizId
     *
     * @return array
     * @throws QuizException
     */
    public function getAllQuestions(int $quizId) : array {

        $collection = [];

        try {

            $questions = $this->questionDataMapper->findByQuizId($quizId);

            foreach ($questions as $question) {
                $questionsDataTransferObject = new QuestionsDataTransferObject();
                $variants = $this->variantDataMapper->findByQuestionId($question->id);
                $questionsDataTransferObject->setQuestion($question);
                $questionsDataTransferObject->addQuestionVariants($variants);
                $collection[] = $questionsDataTransferObject;
            }
            return $collection;
        } catch (DataManagerException $e) {
            throw new QuizException($e->getMessage());
        } catch (\Throwable $e) {
            throw new QuizException('Access denied');
        }
    }

    /**
     * Count total questions
     *
     * @param int $quiz_id
     *
     * @return int
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     * @throws QuizException
     */
    public function countTotalQuestions($quiz_id) : int {
        try {
            return $this->questionDataMapper->countTotal($quiz_id);
        } catch (DataManagerException $e) {
            throw new QuizException($e->getMessage());
        }
    }

    /**
     * Count questions by status
     *
     * @param int $quiz_id
     *
     * @return int
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     * @throws QuizException
     */
    public function countDoneQuestions($quiz_id) : int {
        try {
            return $this->questionDataMapper->countQuestionsByStatus($quiz_id, self::STATUS_DONE);
        } catch (DataManagerException $e) {
            throw new QuizException($e->getMessage());
        }
    }

    /**
     * Get available question
     *
     * @param int $quizId
     *
     * @return QuestionsDataTransferObject
     * @throws QuizException
     */
    public function getAvailableQuestion(int $quizId) : QuestionsDataTransferObject {

        try {
            $question = $this->questionDataMapper->findRandomOneByQuizId($quizId, self::STATUS_PENDING);
            $questionsDataTransferObject = new QuestionsDataTransferObject();

            if(null === $question->id) {
                return $questionsDataTransferObject;
            }

            $variants = $this->variantDataMapper->findByQuestionId($question->id);
            $questionsDataTransferObject->setQuestion($question);
            $questionsDataTransferObject->addQuestionVariants($variants);
            return $questionsDataTransferObject;
        } catch (DataManagerException $e) {
            throw new QuizException($e->getMessage());
        } catch (\Throwable $e) {
            throw new QuizException('Access denied');
        }
    }

    /**
     * Add question
     *
     * @param array $param
     *
     * @return int
     * @throws QuizException
     */
    public function addQuestion(array $param) : int {

        try {

            $this->questionDataMapper->beginTransaction();
            $question = $this->questionDataMapper->addRow(
                $param['quiz_id'],
                $param['title']
            );

            /** @noinspection ForeachSourceInspection */
            foreach($param['variant'] as $variantId => $answer) {

                $right = ((int)$param['answer'] === $variantId) ? 1 : 0;
                $this->variantDataMapper->addRow(
                    $variantId,
                    $question->id,
                    $answer,
                    $right
                );
            }

            $this->questionDataMapper->commitTransaction();
            return $question->id;

        } catch (DataManagerException $e) {
            $this->questionDataMapper->rollbackTransaction();
            throw new QuizException($e);
        }
    }

    /**
     * Delete question
     *
     * @param int $id
     *
     * @return bool
     * @throws QuizException
     */
    public function deleteQuestion(int $id) : bool {

        try {
            return $this->questionDataMapper->removeRow($id);
        } catch (\Throwable $e) {
            throw new QuizException('Access denied');
        }
    }
}