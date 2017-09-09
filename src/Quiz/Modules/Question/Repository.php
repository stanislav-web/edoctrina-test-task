<?php
namespace Quiz\Modules\Question;

/**
 * Class Repository
 * @package Quiz\Modules\Question
 */
class Repository implements RepositoryInterface {

    /**
     * @var QuizModuleService $quizModuleService
     */
    private $quizModuleService;

    /**
     * @var QuestionModuleService $questionModuleService
     */
    private $questionModuleService;

    /**
     * Repository constructor.
     *
     * @param QuizModuleService     $quizModuleService
     * @param QuestionModuleService $questionModuleService
     */
    public function __construct(
        QuizModuleService $quizModuleService,
        QuestionModuleService $questionModuleService
    ) {
        $this->quizModuleService = $quizModuleService;
        $this->questionModuleService = $questionModuleService;
    }

    /**
     * Load `QuizModuleService`
     *
     * @return QuizModuleService
     */
    public function loadQuizModlueService() : QuizModuleService {
        return $this->quizModuleService;
    }

    /**
     * Load `QuestionModuleService`
     *
     * @return QuestionModuleService
     */
    public function loadQuestionModlueService() : QuestionModuleService {
        return $this->questionModuleService;
    }
}