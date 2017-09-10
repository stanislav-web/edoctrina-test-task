<?php
namespace Quiz\Modules\Question\Aware;

use Quiz\Modules\Question\Entities\AbstractEntity;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;

/**
 * Class AbstractDataMapper
 * @package Quiz\Modules\Question\Aware
 */
abstract class AbstractDataMapper {

    /**
     * @var AbstractDatabase $db
     */
    protected $db;

    /**
     * AbstractDataMapper constructor.
     *
     * @param AbstractDatabase $db
     */
    public function __construct(AbstractDatabase $db) {
        $this->db = $db;
    }

    /**
     * Begin transaction
     *
     * @return bool
     */
    public function beginTransaction() : bool {
        return $this->db->begin();
    }

    /**
     * Commit transaction
     *
     * @return bool
     */
    public function commitTransaction() : bool {
        return $this->db->commit();
    }

    /**
     * Rollback transaction
     *
     * @return bool
     */
    public function rollbackTransaction() : bool {
        return $this->db->rollback();
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return AbstractEntity
     */
    abstract protected function mapRow(array $row);

    /**
     * Mapping data from rows to object
     *
     * @param array $rows
     * @throws DataManagerException
     *
     * @return array
     */
    protected function mapRows(array $rows): array {

        $result = [];

        try {
            foreach($rows as $row) {
                $result[] = $this->mapRow($row);
            }
            return $result;

        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}