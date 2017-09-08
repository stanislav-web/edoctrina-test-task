<?php
namespace Quiz\Modules\Question;

/**
 * Interface RepositoryInterface
 * @package Quiz\Modules\Question
 */
interface RepositoryInterface {

    /**
     * Load `QuizService`
     *
     * @return QuizService
     */
    public function loadQuestionService() : QuizService;
}