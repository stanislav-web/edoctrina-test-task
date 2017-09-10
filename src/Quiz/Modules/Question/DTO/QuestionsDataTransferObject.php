<?php
namespace Quiz\Modules\Question\DTO;

use Quiz\Modules\Question\Entities\Question;
use Quiz\Modules\Question\Entities\Variant;

/**
 * Class QuestionsTransferObject
 * @package Quiz\Modules\Question\DTO
 */
class QuestionsDataTransferObject {

    /**
     * @var Question $question
     */
    private $question;

    /**
     * @var Variant[] $questionsVariants
     */
    private $questionsVariants;

    /**
     * @param Question $question
     *
     * @return QuestionsDataTransferObject
     */
    public function setQuestion(Question $question) : QuestionsDataTransferObject{
        $this->question = $question;

        return $this;
    }

    /**
     * @param array $variants
     *
     * @return QuestionsDataTransferObject
     */
    public function addQuestionVariants(array $variants) : QuestionsDataTransferObject {
        $this->questionsVariants = $variants;

        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion() : Question {
        return $this->question;
    }

    /**
     * @return Variant[]
     */
    public function getQuestionVariants() : array {
        return $this->questionsVariants;
    }

    /**
     * @return Variant
     */
    public function getRightVariant() : Variant{

        foreach ($this->questionsVariants as $variant) {
            if(0 < $variant->right) {
                return $variant;
            }
        }
    }
}