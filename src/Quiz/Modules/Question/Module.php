<?php
namespace  Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\ {
    QuestionDataMapper,
    QuizDataMapper,
    ScoreDataMapper,
    VariantDataMapper
};

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
     *
     * @return RepositoryInterface
     * @throws \ReflectionException
     * @throws \Quiz\Modules\Question\Db\Exception\MySQLStorageException
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
            $variantDataMapper = new VariantDataMapper($dbInstance);
            $scoreDataMapper = new ScoreDataMapper($dbInstance);

            $quizModuleService = new QuizModuleService( $quizDataMapper );

            $scoreModuleService = new ScoreModuleService(
                $scoreDataMapper,
                $questionDataMapper,
                $variantDataMapper
            );
            $questionModuleService = new QuestionModuleService(
                $questionDataMapper,
                $variantDataMapper
            );

            $this->repository = new Repository(
                $quizModuleService,
                $questionModuleService,
                $scoreModuleService
                );
        }

        return $this->repository;
    }
}