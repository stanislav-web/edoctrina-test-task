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
     * @var QuizDataMapper $quizDataMapper
     */
    private $quizDataMapper;

    /**
     * Repository constructor.
     *
     * @param QuizDataMapper     $quizDataMapper
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
     */
    public function getAllQuizzes() : array {
        return $this->quizDataMapper->findAll();
    }

    /**
     * Get quiz by id
     *
     * @param int $id
     * @throws DataManagerException
     *
     * @return Entities\Quiz
     */
    public function getQuizById($id) : Entities\Quiz {
        return $this->quizDataMapper->findById((int)$id);
    }

    /**
     * Add quiz
     *
     * @param array $param
     * @throws DataManagerException
     *
     * @return Entities\Quiz
     */
    public function addQuiz(array $param) : Entities\Quiz {
        return $this->quizDataMapper->addRow($param);
    }

    /**
     * Delete quiz
     *
     * @param int $id
     * @throws DataManagerException
     *
     * @return bool
     */
    public function deleteQuiz(int $id) : bool {
        return $this->quizDataMapper->removeRow($id);
    }
}