<?php
namespace Quiz\Modules\Question;

/**
 * Interface RepositoryInterface
 * @package Quiz\Modules\Question
 */
interface RepositoryInterface {

    /**
     * Load `QuizModuleService`
     *
     * @return QuizModuleService
     */
    public function loadQuizModlueService() : QuizModuleService;

    /**
     * Load `QuestionModuleService`
     *
     * @return QuestionModuleService
     */
    public function loadQuestionModlueService() : QuestionModuleService;
}