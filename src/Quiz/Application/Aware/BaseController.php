<?php
namespace Quiz\Application\Aware;
use Quiz\Aware\DependencyContainerInterface;

/**
 * Class BaseController
 * @package Quiz\Application\Aware
 */
abstract class BaseController {

    /**
     * @var DependencyContainerInterface $dic
     */
    protected $dic;

    /**
     * BaseController constructor.
     *
     * @param DependencyContainerInterface $dic
     */
    public function __construct(DependencyContainerInterface $dic) {
        $this->dic = $dic;
    }
}