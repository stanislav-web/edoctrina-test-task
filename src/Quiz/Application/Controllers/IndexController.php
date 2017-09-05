<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
use Quiz\Aware\DependencyContainerInterface;
use Quiz\Modules\View\Repository;
use Quiz\Modules\View\RepositoryInterface;

/**
 * Class IndexController
 * @package Quiz\Application\Controllers
 */
class IndexController extends BaseController {

    /**
     * @var RepositoryInterface|Repository
     */
    private $view;

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
        $this->view->setMetaData([
            'title'       => 'Quiz Dashboard',
            'description' => 'Quiz Dashboard description',
        ]);
        $this->view->setLayout('bootstrap');
    }

    public function indexAction() {
       echo $this->view->render('index', [
           'test' => 'ok'
       ]);
    }
}