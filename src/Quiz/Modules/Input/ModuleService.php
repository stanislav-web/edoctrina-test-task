<?php
namespace Quiz\Modules\Input;

use Quiz\Modules\Input\Entities\GetVars;
use Quiz\Modules\Input\Entities\PostVars;

/**
 * Class ModuleService
 * @package Quiz\Modules\Input
 */
class ModuleService {

    /**
     * @var GetVars $getVars
     */
    private $getVars;

    /**
     * @var PostVars $postVars
     */
    private $postVars;

    /**
     * ModuleService constructor.
     *
     * @param GetVars  $getVars
     * @param PostVars $postVars
     */
    public function __construct(GetVars $getVars, PostVars $postVars) {
        $this->getVars = $getVars;
        $this->postVars = $postVars;
    }

    /**
     * @return GetVars
     */
    public function getVars() : GetVars {
        return $this->getVars;
    }

    /**
     * @return PostVars
     */
    public function postVars() : PostVars {
        return $this->postVars;
    }

}