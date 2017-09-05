<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;

/**
 * Class IndexController
 * @package Quiz\Application\Controllers
 */
class IndexController extends BaseController {

    public function indexAction() {
        echo __CLASS__.__METHOD__;
    }
}