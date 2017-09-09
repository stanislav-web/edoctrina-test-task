<?php
namespace Quiz\Modules\View;

use Quiz\Modules\View\Entities\Meta;
use Quiz\Modules\View\Entities\View;

/**
 * Class QuizModuleService
 * @package Quiz\Modules\View
 */
class ModuleService {

    /**
     * @var Meta $meta
     */
    private $meta;

    /**
     * @var View $view
     */
    private $view;

    /**
     * QuizModuleService constructor.
     *
     * @param Meta $meta
     * @param View $view
     */
    public function __construct(Meta $meta, View $view) {
        $this->meta = $meta;
        $this->view = $view;
    }

    /**
     * @return Meta
     */
    public function getMeta() : Meta {
        return $this->meta;
    }

    /**
     * @return View
     */
    public function getView() : View {
        return $this->view;
    }

}