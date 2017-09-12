<?php
namespace Quiz\Application\Aware;
use Quiz\Aware\DependencyContainerInterface;
use Quiz\Modules\View\Module as ViewModule;
use Quiz\Modules\Question\Module as QuestionModule;
use Quiz\Modules\Input\Module as InputModule;

/**
 * Class BaseController
 * @package Quiz\Application\Aware
 */
abstract class BaseController {

    /**
     * @const MAIN_LAYOUT
     */
    const MAIN_LAYOUT = 'bootstrap';

    /**
     * @var DependencyContainerInterface $di
     */
    protected $di;

    /**
     * @var ViewModule $viewModule
     */
    protected $viewModule;

    /**
     * @var InputModule $inputModule
     */
    protected $inputModule;

    /**
     * @var QuestionModule $questionModule
     */
    protected $questionModule;

    /**
     * BaseController constructor.
     *
     * @param DependencyContainerInterface $di
     *
     * @throws \Quiz\Exceptions\DependencyContainerException
     */
    public function __construct(DependencyContainerInterface $di) {

        $this->inputModule = $di->get('Input');
        $this->viewModule = $di->get('View');
        $this->questionModule = $di->get('Question');

        $this->view = $this->viewModule->getRepository();
        $this->view->setLayout(self::MAIN_LAYOUT);
    }

    /**
     * Redirect action
     *
     * @param array $params
     *
     * @return void
     */
    public function redirectTo(array $params): void {
        header('location: ?'. http_build_query($params));
    }

}