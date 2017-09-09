<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\DataManager\QuestionDataMapper;

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
     * Repository constructor.
     *
     * @param QuestionDataMapper     $questionDataMapper
     */
    public function __construct(
        QuestionDataMapper $questionDataMapper) {
        $this->questionDataMapper = $questionDataMapper;
    }

    /**
     * Get all questions
     *
     * @param int $quizId
     * @throws DataManagerException
     *
     * @return Entities\Question[]|array
     */
    public function getAllQuestions($quizId) : array {
        return $this->questionDataMapper->findByQuizId((int)$quizId);
    }
}