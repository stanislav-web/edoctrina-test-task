<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Aware\DependencyContainerInterface;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\View\Repository as ViewRepository;
use Quiz\Modules\View\RepositoryInterface as ViewRepositoryInterface;

/**
 * Class QuizController
 * @package Quiz\Application\Controllers
 */
class QuizController extends BaseController {

    /**
     * @var ViewRepositoryInterface|ViewRepository
     */
    private $view;

    /**
     * QuizController constructor.
     *
     * @param DependencyContainerInterface $di
     *
     * @throws \Quiz\Exceptions\DependencyContainerException
     */
    public function __construct(DependencyContainerInterface $di) {
        parent::__construct($di);

        $this->view = $this->viewModule->getRepository();
        $this->view->setLayout('bootstrap');
    }

    /**
     * List of quiz
     */
    public function listAction() {

        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadModlueService();

        $this->view->setMetaData([
            'title'       => 'List of quizes',
        ]);

        echo $this->view->render('quiz_list', [
            'quizList' => $questionModuleService->getAllQuiz()
        ]);
    }

    /**
     * Create quiz
     */
    public function createAction() {

        $input = $this->inputModule->getRepository();
        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadModlueService();
        $viewData = [];

        if(true === $input->isPost()) {

            try {
                $quiz = $questionModuleService->addQuiz($input->post());
                $this->redirectTo([
                    'controller' => 'question',
                    'quiz_id' => $quiz->id
                ]);
            } catch (DataManagerException $e) {
                $viewData['status'] = 'danger';
                $viewData['message'] = $e->getMessage();
            }
        }

        $this->view->setMetaData([
            'title'       => 'Create quiz',
        ]);

        echo $this->view->render('quiz_create', $viewData);
    }

    /**
     * Delete quiz
     */
    public function deleteAction() {

        $input = $this->inputModule->getRepository();
        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadModlueService();

        try {
            $questionModuleService->deleteQuiz($input->get('id'));

            $this->redirectTo([
                'controller' => 'quiz',
                'action' => 'list',
            ]);

        } catch (DataManagerException $e) {

            $this->view->setMetaData([
                'title'       => 'List of quizzes',
            ]);

            echo $this->view->render('quiz_list', [
                'status' => 'danger',
                'message' => 'An error occurred while removing the quiz',
                'quizList' => $questionModuleService->getAllQuiz()
            ]);

            return;
        }
    }
}