<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDataMapper;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Entities\Variant;

/**
 * Class VariantDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class VariantDataMapper extends AbstractDataMapper {

    /**
     * @const TABLE
     */
    const TABLE = 'variants';

    /**
     * Find row by question and variant ids
     *
     * @param int $question_id
     * @param int $variant_id
     *
     * @throws DataManagerException
     * @return Variant
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function findByQuestionVariantId(int $question_id, $variant_id): Variant {

        $query = 'SELECT `id`, `question_id`, `title`, `right`
                    FROM ' .self::TABLE.'
                    WHERE `question_id` = :question_id AND `id` = :id';

        $result = $this->db->fetch($query, [
            ':id' => $variant_id,
            ':question_id' => $question_id,
        ]);

        if (null === $result) {
            throw new DataManagerException('Variant #'.$variant_id.' not found');
        }

        return $this->mapRow($result);
    }

    /**
     * Find row by question id
     *
     * @param int $questionId
     *
     * @throws DataManagerException
     * @return Variant[]|array
     * @throws \Quiz\Modules\Question\Db\Exception\StorageException
     */
    public function findByQuestionId(int $questionId): array {

        $query = 'SELECT `id`, `question_id`, `title`, `right`
                    FROM ' .self::TABLE. ' 
                    WHERE question_id = :question_id';

        $result = $this->db->fetchAll($query, ['question_id' => $questionId]);

        if (null === $result) {
            throw new DataManagerException('Variants not found');
        }

        return $this->mapRows($result);
    }
    /**
     * Add row
     *
     * @param int $id
     * @param int $question_id
     * @param string    $title
     * @param string    $right
     *
     * @return int
     * @throws DataManagerException
     */
    public function addRow(int $id, int $question_id, $title, $right): int {

        try {
            $query = 'INSERT INTO  ' .self::TABLE. ' (`id`, `question_id`,`title`,`right`) VALUES (
                        :id, 
                        :question_id, 
                        :title,
                        :right
                    )';

            $rowId = $this->db->insert($query, [
                'id' => $id,
                'question_id' => $question_id,
                'title' => trim($title),
                'right' => $right
            ]);

            return $rowId;

        } catch (\Throwable $e) {
            throw new DataManagerException('Variant does not added');
        }
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return Variant
     */
    protected function mapRow(array $row): Variant
    {

        try {
            $variant = new Variant();
            $variant->setFromArray($row);
            return $variant;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}