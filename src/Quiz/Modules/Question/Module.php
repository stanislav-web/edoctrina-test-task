<?php
namespace  Quiz\Modules\Question;

use Quiz\Aware\DependencyContainerInterface;
use Quiz\Aware\ModuleInterface;

/**
 * Class Module
 * @package Quiz\Module\Question
 */
class Module implements ModuleInterface {

    /**
     * @var DependencyContainerInterface $dic
     */
    private $dic;

    /**
     * Module constructor.
     *
     * @param DependencyContainerInterface $dic
     */
    public function __construct(DependencyContainerInterface $dic) {
        $this->dic = $dic;
    }
}