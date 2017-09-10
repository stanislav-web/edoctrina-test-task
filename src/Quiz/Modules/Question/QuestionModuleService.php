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
     * @var QuestionDataMapper $questionDataMapper
     */
    private $questionDataMapper;

    /**
     * @var VariantDataMapper $variantDataMapper
     */
    private $variantDataMapper;


    /**
     * Repository constructor.
     *
     * @param QuestionDataMapper     $questionDataMapper
     * @param VariantDataMapper     $variantDataMapper
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
     * @throws DataManagerException
     *
     * @return QuestionsDataTransferObject[]|[]
     */
    public function getAllQuestions(int $quizId) : array {

        $collection = [];
        $questions = $this->questionDataMapper->findByQuizId($quizId);

        foreach($questions as $question) {
            $questionsDataTransferObject = new QuestionsDataTransferObject();
            $variants = $this->variantDataMapper->findByQuestionId($question->id);
            $questionsDataTransferObject->setQuestion($question);
            $questionsDataTransferObject->addQuestionVariants($variants);
            $collection[] = $questionsDataTransferObject;
        }
        return $collection;
    }

    /**
     * Add question
     *
     * @param array     $param
     * @throws DataManagerException
     *
     * @return int
     */
    public function addQuestion(array $param) : int {

        try {

            $this->questionDataMapper->beginTransaction();
            $question = $this->questionDataMapper->addRow(
                $param['quiz_id'],
                $param['title']
            );

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
            throw new \Exception($e);
        }
    }

    /**
     * Delete question
     *
     * @param int $id
     * @throws DataManagerException
     *
     * @return bool
     */
    public function deleteQuestion(int $id) : bool {
        return $this->questionDataMapper->removeRow($id);
    }
}