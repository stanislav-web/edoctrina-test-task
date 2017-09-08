<?php
namespace  Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\QuestionDataMapper;
use Quiz\Modules\Question\DataManager\QuizDataMapper;
use Quiz\Modules\Question\DataManager\UserDataMapper;
use Quiz\Modules\Question\Db\Exception\MySQLStorageException;

/**
 * Class Module
 * @package Quiz\Module\Question
 */
class Module implements ModuleInterface {

    /**
     * Default storage driver
     */
    const DB_DRIVER = Db\MySQL::class;

    /**
     * @var RepositoryInterface $repository
     */
    private $repository;

    /**
     * Get module config
     *
     * @return \stdClass
     */
    public function getConfig(): \stdClass {
        return (object)include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get "lazy" module repository
     * @throws MySQLStorageException
     * @throws \ReflectionException
     * @return RepositoryInterface
     */
    public function getRepository() : RepositoryInterface {

        if(null === $this->repository) {

            $dbReflectionClass = new \ReflectionClass(self::DB_DRIVER);
            $dbConfig = (object)$this->getConfig()->adapters[$dbReflectionClass->getShortName()];
            $dbAdapter = $dbReflectionClass->newInstanceArgs([$dbConfig]);
            /** @noinspection PhpParamsInspection */
            $dbInstance = new Db($dbAdapter);

            $quizDataMapper = new QuizDataMapper($dbInstance);
            $questionDataMapper = new QuestionDataMapper($dbInstance);
            $userDataMapper = new UserDataMapper($dbInstance);

            $moduleService = new ModuleService( $quizDataMapper , $questionDataMapper, $userDataMapper);

            $this->repository = new Repository($moduleService);
        }

        return $this->repository;
    }
}