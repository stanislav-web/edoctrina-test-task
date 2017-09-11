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
     * @var ScoreModuleService $scoreModuleService
     */
    private $scoreModuleService;

    /**
     * Repository constructor.
     *
     * @param QuizModuleService     $quizModuleService
     * @param QuestionModuleService $questionModuleService
     * @param ScoreModuleService    $scoreModuleService
     */
    public function __construct(
        QuizModuleService $quizModuleService,
        QuestionModuleService $questionModuleService,
        ScoreModuleService $scoreModuleService
    ) {
        $this->quizModuleService = $quizModuleService;
        $this->questionModuleService = $questionModuleService;
        $this->scoreModuleService = $scoreModuleService;
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

    /**
     * Load `ScoreModuleService`
     *
     * @return ScoreModuleService
     */
    public function loadScoreModlueService() : ScoreModuleService {
        return $this->scoreModuleService;
    }
}