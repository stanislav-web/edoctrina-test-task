<?php
namespace Quiz\Modules\Question;

use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\DataManager\QuestionDataMapper;
use Quiz\Modules\Question\DataManager\QuizDataMapper;
use Quiz\Modules\Question\DataManager\UserDataMapper;

/**
 * Class ModuleService
 * @package Quiz\Modules\Question
 */
class ModuleService {

    /**
     * @var QuizDataMapper $quizDataMapper
     */
    private $quizDataMapper;

    /**
     * @var QuestionDataMapper $questionDataMapper
     */
//    private $questionDataMapper;

    /**
     * @var UserDataMapper $userDataMapper
     */
//    private $userDataMapper;

    /**
     * Repository constructor.
     *
     * @param QuizDataMapper     $quizDataMapper
     * @param QuestionDataMapper $questionDataMapper
     * @param UserDataMapper     $userDataMapper
     */
    public function __construct(
        QuizDataMapper $quizDataMapper,
        QuestionDataMapper $questionDataMapper,
        UserDataMapper $userDataMapper) {

        $this->quizDataMapper = $quizDataMapper;
        //        $this->questionDataMapper = $questionDataMapper;
        //        $this->userDataMapper = $userDataMapper;
    }

    /**
     * Get all quiz
     *
     * @throws DataManagerException
     *
     * @return Entities\Quiz[]|array
     */
    public function getAllQuiz() : array {
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
        return $this->quizDataMapper->findById($id);
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



}