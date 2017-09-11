<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\DataManager\QuizDataMapper;

/**
 * Class QuizModuleService
 * @package Quiz\Modules\Question
 */
class QuizModuleService {

    /**
     * @cost STATUS_PENDING
     * @cost STATUS_PROGRESS
     * @cost STATUS_DONE
     */
    const STATUS_PENDING    = 'pending';
    const STATUS_PROGRESS   = 'progress';
    const STATUS_DONE       = 'done';

    /**
     * @var QuizDataMapper $quizDataMapper
     */
    private $quizDataMapper;

    /**
     * QuizModuleService constructor.
     *
     * @param QuizDataMapper $quizDataMapper
     */
    public function __construct(QuizDataMapper $quizDataMapper) {
        $this->quizDataMapper = $quizDataMapper;
    }

    /**
     * Get all quizzes
     *
     * @throws DataManagerException
     *
     * @return Entities\Quiz[]|array
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function getAllQuizzes() : array {
        return $this->quizDataMapper->findAll();
    }

    /**
     * Get quiz by id
     *
     * @param int $id
     *
     * @return Entities\Quiz
     * @throws QuizException
     */
    public function getQuizById(int $id) : Entities\Quiz {

        try {
            return $this->quizDataMapper->findById($id);
        } catch (\Throwable $e) {
            throw new QuizException('Access denied');
        }
    }

    /**
     * Add quiz
     *
     * @param array $param
     *
     * @return Entities\Quiz
     * @throws QuizException
     */
    public function addQuiz(array $param) : Entities\Quiz {

        try {

            return $this->quizDataMapper->addRow(
                $param['name'],
                $param['description']
            );
        } catch (DataManagerException $e) {
            throw new QuizException($e->getMessage());
        }
        catch (\Throwable $e) {
            throw new QuizException('Access denied');
        }
    }

    /**
     * Set quizz in progress
     *
     * @param int $id
     *
     * @return bool
     * @throws QuizException
     */
    public function startProgress(int $id) : bool {

        try {
            return $this->quizDataMapper->updateStatusRow($id, self::STATUS_PROGRESS);
        } catch (\Throwable $e) {
            throw new QuizException('Undefined error');
        }
    }

    /**
     * Set quiz in progress
     *
     * @param int $id
     *
     * @return bool
     * @throws QuizException
     */
    public function doneProgress(int $id) : bool {

        try {
            return $this->quizDataMapper->updateStatusRow($id, self::STATUS_DONE);
        } catch (\Throwable $e) {
            throw new QuizException('Undefined error');
        }
    }

    /**
     * Delete quiz
     *
     * @param int $id
     *
     * @return bool
     * @throws QuizException
     */
    public function deleteQuiz(int $id) : bool {

        try {
            return $this->quizDataMapper->removeRow($id);
        } catch (\Throwable $e) {
            throw new QuizException('Access denied');
        }
    }
}