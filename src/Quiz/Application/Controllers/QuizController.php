<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Aware\DependencyContainerInterface;
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
     * List of quizzes
     *
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     * @throws \Quiz\Modules\Question\DataManager\Exception\DataManagerException
     * @throws \Quiz\Modules\Input\InputException
     */
    public function listAction() {

        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadModlueService();

        $this->view->setMetaData([
            'title'       => 'List of quizes',
        ]);

        echo $this->view->render('list', [
            'quizList' => $questionModuleService->getAllQuiz()
        ]);
    }

    /**
     * Create quiz
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     * @throws \Quiz\Modules\Question\DataManager\Exception\DataManagerException
     * @throws \Quiz\Modules\Input\InputException
     */
    public function createAction() {

        $input = $this->inputModule->getRepository();
        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadModlueService();

        if(true === $input->isPost()) {

            $quiz = $questionModuleService->addQuiz($input->post());

            $this->redirectTo([
                'controller' => 'quiz',
                'action' => 'view',
                'id' => $quiz->id
            ]);
        }

        $this->view->setMetaData([
            'title'       => 'Create quiz',
        ]);

        echo $this->view->render('create', [
            'quizList' => $questionModuleService->getAllQuiz()
        ]);
    }
}