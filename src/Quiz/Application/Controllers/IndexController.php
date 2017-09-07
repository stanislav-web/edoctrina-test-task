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
     */
    public function indexAction() {
        $this->view->setMetaData([
            'title'       => 'Quiz Dashboard',
            'description' => 'Quiz Dashboard description',
        ]);

        echo $this->view->render('index', [
           'test' => 'ok'
        ]);
    }

    /**
     * Create Quiz action
     * @throws \Quiz\Modules\Input\InputException
     */
    public function createAction() {

        $this->input = $this->inputModule->getRepository();
        //$this->input->get();
        // $this->input->post()

        $this->view->setMetaData([
            'title'       => 'Create Quiz'
        ]);

        echo $this->view->render('create', [
            'test' => 'ok'
        ]);
    }
}