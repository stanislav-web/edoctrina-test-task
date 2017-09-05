<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;

/**
 * Class UserController
 * @package Quiz\Application\Controllers
 */
class UserController extends BaseController {

    public function indexAction() {
        echo __CLASS__.__METHOD__;
    }
}