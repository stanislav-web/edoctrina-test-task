<?php
namespace  Quiz\Modules\Question;

/**
 * Interface ModuleInterface
 * @package Quiz\Aware
 */
interface ModuleInterface {

    /**
     * Get module config
     *
     * @return \stdClass
     */
    public function getConfig() : \stdClass;

    /**
     * Get "lazy" module repository
     *
     * @throws QuizException
     *
     * @return RepositoryInterface
     */
    public function getRepository() : RepositoryInterface;
}