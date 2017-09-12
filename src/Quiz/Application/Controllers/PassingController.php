<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Modules\Question\Entities\Quiz;
use Quiz\Modules\View\Repository as ViewRepository;
use Quiz\Modules\View\RepositoryInterface as ViewRepositoryInterface;
use Quiz\Modules\Question\RepositoryInterface as QuestionRepositoryInterface;
use Quiz\Modules\Input\RepositoryInterface as InputRepositoryInterface;

/**
 * Class PassingController
 * @package Quiz\Application\Controllers
 */
class PassingController extends BaseController {

    /**
     * @var ViewRepositoryInterface|ViewRepository
     */
    protected $view;

    /**
     * Index action
     * @throws \Quiz\Modules\Question\QuizException
     * @throws \Quiz\Modules\Input\InputException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     */
    public function indexAction() {

        $input = $this->inputModule->getRepository();
        $question = $this->questionModule->getRepository();
        $quizModuleService = $question->loadQuizModlueService();
        $quiz = $quizModuleService->getQuizById($input->get('quiz_id'));

        // check current quiz status and get back if already in progress
        if($quiz->status === $quizModuleService::STATUS_PROGRESS) {
            $this->redirectTo([
                'controller' => 'quiz',
                'action' => 'list'
            ]);
        }

        $quizModuleService->startProgress($quiz->id);

        $this->redirectTo([
            'controller' => 'passing',
            'action' => 'progress',
            'quiz_id' => $quiz->id
        ]);
    }

    /**
     * Progress action
     * @throws \Quiz\Modules\View\ViewException
     * @throws \Quiz\Modules\Question\QuizException
     * @throws \Quiz\Modules\Input\InputException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     */
    public function progressAction() {

        $input = $this->inputModule->getRepository();
        $questionRepository = $this->questionModule->getRepository();

        $quizService = $questionRepository->loadQuizModlueService();
        $questionService = $questionRepository->loadQuestionModlueService();

        $quiz = $quizService->getQuizById( $input->get('quiz_id'));

        try {

            if($input->isPost()) {
                $this->processPassing($questionRepository, $input, $quiz);

            }
            $totalQuestions = $questionService->countTotalQuestions($quiz->id);
            $doneQuestions  = $questionService->countDoneQuestions($quiz->id);

            if($doneQuestions === $totalQuestions) {

                $quizService->doneProgress($quiz->id);

                /** @noinspection PhpVoidFunctionResultUsedInspection */
                return $this->redirectTo([
                    'controller' => 'passing',
                    'action' => 'done',
                    'quiz_id' => $quiz->id
                ]);
            }

            $questionDto = $questionService->getAvailableQuestion($quiz->id);

            echo $this->view->setMetaData([
                'title'       => $quiz->name,
            ])->render('quest', [
                'total'   => $questionService->countTotalQuestions($quiz->id),
                'done'    => $questionService->countDoneQuestions($quiz->id),
                'question' => $questionDto->getQuestion(),
                'variants' => $questionDto->getQuestionVariants()
            ]);
        } catch (\Throwable $e) {
            echo $this->view->setMetaData([
                'title'       => $e->getMessage(),
            ])->render('quest', [
                'status' => 'danger',
                'message' =>  $e->getMessage(),
            ]);
        }

        return null;
    }

    /**
     * Done action
     * @throws \Quiz\Modules\Question\QuizException
     * @throws \Quiz\Modules\View\ViewException
     * @throws \Quiz\Modules\Input\InputException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function doneAction() {

        $input = $this->inputModule->getRepository();
        $questionRepository = $this->questionModule->getRepository();
        $quizId = $input->get('quiz_id');

        $quizModuleService = $questionRepository->loadQuizModlueService();
        $questionModuleService = $questionRepository->loadQuestionModlueService();
        $scoreModuleService = $questionRepository->loadScoreModlueService();

        echo $this->view->setMetaData([
            'title'       => 'Your quest is done',
        ])->render('done', [
            'quiz'  =>  $quizModuleService->getQuizById($quizId),
            'questionsList' => $questionModuleService->getAllQuestions($quizId),
            'scoreResult'     => $scoreModuleService->getQuizScoreResult($quizId),
            'score'     => $scoreModuleService->getQuizScore($quizId)
        ]);
    }

    /**
     * Process quest passing
     *
     * @param QuestionRepositoryInterface $questionRepository
     * @param InputRepositoryInterface    $input
     * @param Quiz                        $quiz
     *
     * @return int
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     * @throws \Quiz\Modules\Question\QuizException
     */
    private function processPassing(
        QuestionRepositoryInterface $questionRepository,
        InputRepositoryInterface $input,
        Quiz $quiz): int
    {

        $result = $questionRepository->loadScoreModlueService()->addResultRow(
            $quiz->id,
            $input->post('question_id'),
            $input->post('answer')
        );

        return $result;
    }
}