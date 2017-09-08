<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Aware\DependencyContainerInterface;
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
    private $view;

    /**
     * QuestionController constructor.
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
     * List of questions
     *
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     * @throws \Quiz\Modules\Question\DataManager\Exception\DataManagerException
     * @throws \Quiz\Modules\Input\InputException
     */
    public function indexAction() {

        $question = $this->questionModule->getRepository();
        $questionModuleService = $question->loadModlueService();

        $this->view->setMetaData([
            'title'       => 'List of Questions',
        ]);

        echo $this->view->render('questions_list', [
            'quizList' => $questionModuleService->getAllQuiz()
        ]);
    }
}