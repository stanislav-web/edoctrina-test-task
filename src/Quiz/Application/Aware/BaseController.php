<?php
namespace Quiz\Application\Aware;
use Quiz\Aware\DependencyContainerInterface;
use Quiz\Modules\View\Module as ViewModule;
use Quiz\Modules\Question\Module as QuestionModule;
use Quiz\Modules\User\Module as UserModule;

/**
 * Class BaseController
 * @package Quiz\Application\Aware
 */
abstract class BaseController {

    /**
     * @var DependencyContainerInterface $di
     */
    protected $di;

    /**
     * @var ViewModule $viewModule
     */
    protected $viewModule;

    /**
     * @var QuestionModule $questionModule
     */
    protected $questionModule;

    /**
     * @var UserModule $userModule
     */
    protected $userModule;

    /**
     * BaseController constructor.
     *
     * @param DependencyContainerInterface $di
     *
     * @throws \Quiz\Exceptions\DependencyContainerException
     */
    public function __construct(DependencyContainerInterface $di) {
        $this->viewModule = $di->get('View');
        $this->questionModule = $di->get('Question');
        $this->userModule = $di->get('User');
    }

}