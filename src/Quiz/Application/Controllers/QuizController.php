<?php
namespace Quiz\Application\Controllers;

use Quiz\Application\Aware\BaseController;

/**
 * Class QuizController
 * @package Quiz\Application\Controllers
 */
class QuizController extends BaseController {

    public function indexAction() {
        echo __CLASS__.__METHOD__;
    }
}