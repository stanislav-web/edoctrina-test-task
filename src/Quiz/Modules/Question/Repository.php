<?php
namespace Quiz\Modules\Question;

/**
 * Class Repository
 * @package Quiz\Modules\Question
 */
class Repository implements RepositoryInterface {

    /**
     * @var QuizService $questionService
     */
    private $questionService;

    /**
     * Repository constructor.
     *
     * @param QuizService $questionService
     */
    public function __construct(QuizService $questionService) {
        $this->questionService = $questionService;
    }

    /**
     * Load `QuizService`
     *
     * @return QuizService
     */
    public function loadQuestionService() : QuizService {
        return $this->questionService;
    }
}