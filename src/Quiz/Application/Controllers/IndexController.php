<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Aware\DependencyContainerInterface;
use Quiz\Modules\Input\Repository as InputRepository;
use Quiz\Modules\Input\RepositoryInterface as InputRepositoryInterface;
use Quiz\Modules\View\Repository as ViewRepository;
use Quiz\Modules\View\RepositoryInterface as ViewRepositoryInterface;

/**
 * Class IndexController
 * @package Quiz\Application\Controllers
 */
class IndexController extends BaseController {

    /**
     * @var ViewRepositoryInterface|ViewRepository
     */
    private $view;

    /**
     * @var InputRepositoryInterface|InputRepository
     */
    private $input;

    /**
     * IndexController constructor.
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
     * Index action (Dashboard) entry point
     *
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
     * @throws \ReflectionException
     * @throws \Quiz\Modules\Question\DataManager\Exception\DataManagerException
     * @throws \Quiz\Modules\Input\InputException
     */
    public function indexAction() {

        $question = $this->questionModule->getRepository();
        $input = $this->inputModule->getRepository();

        $questionService = $question->loadQuestionService();
        //var_dump($input->get()); exit;

        $this->view->setMetaData([
            'title'       => 'Quiz Dashboard',
            'description' => 'Quiz Dashboard description',
        ]);

        echo $this->view->render('index', [
           'quiz' => $questionService->getAllQuiz()
        ]);
    }
}