<?php
namespace Quiz\Modules\View;

use Quiz\Modules\View\Entities\Meta;
use Quiz\Modules\View\Entities\View;

/**
 * Class Repository
 * @package Quiz\Modules\View
 */
class Repository implements RepositoryInterface {

    /**
     * @var \stdClass $config
     */
    private $config;

    /**
     * @var Meta $meta
     */
    private $meta;

    /**
     * @var View $view
     */
    private $view;

    /**
     * Repository constructor.
     *
     * @param \stdClass $config
     * @param ValueObject $valueObject
     */
    public function __construct(\stdClass $config, ValueObject $valueObject) {
        $this->config = $config;
        $this->meta = $valueObject->getMeta();
        $this->view = $valueObject->getView();
    }

    /**
     * Set meta data from array
     *
     * @param array $param
     *
     * @return RepositoryInterface
     */
    public function setMetaData(array $param) : RepositoryInterface {
        $this->meta->setFromArray($param);
        return $this;
    }

    /**
     * Get meta data
     *
     * @return Meta
     */
    public function getMetaData() : Meta {
        return $this->meta;
    }

    /**
     * Set layout
     *
     * @param string $layout
     * @return RepositoryInterface
     */
    public function setLayout($layout): RepositoryInterface {
        $this->view->layout = vsprintf($this->config->layout, [
            $layout, $this->config->extension
        ]);

        return $this;
    }

    /**
     * Render view
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     * @throws ViewException
     */
    public function render($template, array $data = []): string {

        $layoutName = pathinfo($this->view->layout, PATHINFO_FILENAME);

        if(false === isset($this->config->templates[$layoutName])) {
            throw new ViewException('`'.$layoutName.'` was not found');
        }

        if(array_key_exists($layoutName, $this->view->vars)
            || array_key_exists('template', $this->view->vars)) {
            throw new ViewException("Cannot bind variable called `'.$layoutName.'`");
        }


        $templatesArray = $this->config->templates[$layoutName];
        $templatePath = vsprintf($templatesArray[$template], [
            $layoutName, $this->config->extension
        ]);

        if(false === file_exists($templatePath)) {
            throw new ViewException('`'.$template.'` was not found');
        }

        $this->view->vars = $data;
        $this->addTemplatePath($templatePath);
        $this->addMetaData();
        $template = $this->renderTemplate($this->view->layout);
        return $template;
    }

    /**
     * Render template
     *
     * @param string $templatePath
     *
     * @return string
     */
    private function renderTemplate($templatePath) : string {

        // for a similar system this will not do harm
        extract($this->view->vars, EXTR_OVERWRITE);
        ob_start();
        /** @noinspection PhpIncludeInspection */
        include $templatePath;
        return ob_get_clean();
    }

    /**
     * Add template path
     *
     * @param $templatePath
     */
    private function addTemplatePath($templatePath) {

        $this->view->vars['template'] = $this->renderTemplate($templatePath);
    }

    /**
     * Add meta data to template
     */
    private function addMetaData() {

        $this->view->vars['title'] = $this->getMetaData()->title;
        $this->view->vars['charset'] = $this->getMetaData()->charset;
        $this->view->vars['description'] = $this->getMetaData()->description;

    }
}