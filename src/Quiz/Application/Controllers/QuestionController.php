<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Aware\DependencyContainerInterface;
use Quiz\Modules\Question\QuizException;
use Quiz\Modules\View\Repository as ViewRepository;
use Quiz\Modules\View\RepositoryInterface as ViewRepositoryInterface;

/**
 * Class QuestionController
 * @package Quiz\Application\Controllers
 */
class QuestionController extends BaseController {

    /**
     * @var ViewRepositoryInterface|ViewRepository
     */
    protected $view;

    /**
     * List of questions
     * @throws \Quiz\Modules\Input\InputException
     * @throws \Quiz\Modules\Question\QuizException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     */
    public function listAction() {

        $input = $this->inputModule->getRepository();
        $quizId = $input->get('quiz_id');

        $question = $this->questionModule->getRepository();
        $quizModuleService = $question->loadQuizModlueService();
        $questionModuleService = $question->loadQuestionModlueService();
        $this->view->setMetaData([
            'title'       => 'Questions list',
        ]);

        echo $this->view->render('questions_list', [
            'quiz' => $quizModuleService->getQuizById($quizId),
            'config' => $this->questionModule->getConfig(),
            'questionsList' =>  $questionModuleService->getAllQuestions($quizId)
        ]);
    }

    /**
     * Create question
     * @throws \Quiz\Modules\Input\InputException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     */
    public function createAction() {

        $input = $this->inputModule->getRepository();
        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadQuestionModlueService();
        $viewData = [];

        if(true === $input->isPost()) {

            try {
                $questionModuleService->addQuestion($input->post());

                $this->redirectTo([
                    'controller' => 'question',
                    'action' => 'list',
                    'quiz_id' => $input->post('quiz_id')
                ]);
            } catch (\Throwable $e) {
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
     * Delete question
     * @throws \Quiz\Modules\Input\InputException
     * @throws \Quiz\Modules\Question\DataManager\Exception\DataManagerException
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     */
    public function deleteAction() {

        $input = $this->inputModule->getRepository();
        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadQuestionModlueService();

        try {
            $questionModuleService->deleteQuestion($input->get('id'));

            $this->redirectTo([
                'controller' => 'question',
                'action' => 'list',
                'quiz_id' => $input->get('quiz_id'),
            ]);

        } catch (QuizException $e) {

            $this->view->setMetaData([
                'title'       => 'List of quizzes',
            ]);

            echo $this->view->render('quiz_list', [
                'status' => 'danger',
                'message' => 'An error occurred while removing the quiz',
                'quizList' => $question->loadQuizModlueService()->getAllQuizzes()
            ]);

            return;
        }
    }

}