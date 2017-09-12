<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;
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
    protected $view;

    /**
     * (Dashboard) entry point
     */
    public function indexAction() {

        $this->view->setMetaData([
            'title'       => 'Quiz Dashboard',
            'description' => 'Quiz Dashboard description',
        ]);

        echo $this->view->render('index');
    }
}