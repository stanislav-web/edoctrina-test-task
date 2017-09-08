<?php
namespace Quiz\Modules\Question\DataManager;

use Quiz\Modules\Question\Aware\AbstractDatabase;
use Quiz\Modules\Question\DataManager\Exception\DataManagerException;
use Quiz\Modules\Question\Entities\User;

/**
 * Class UserDataMapper
 * @package Quiz\Modules\Question\DataManager
 */
class UserDataMapper {

    /**
     * @const TABLE
     */
    const TABLE = 'users';

    /**
     * @var AbstractDatabase $db
     */
    private $db;

    /**
     * QuizDataMapper constructor.
     *
     * @param AbstractDatabase $db
     */
    public function __construct(AbstractDatabase $db) {
        $this->db = $db;
    }

    /**
     * Find row by id
     *
     * @param int $id
     * @throws DataManagerException
     *
     * @return User
     */
    public function findById(int $id): User
    {
        $query = 'SELECT `id`, `name` 
                    FROM ' .self::TABLE. ' 
                    WHERE id = :id';

        $result = $this->db->fetchById($query, $id);

        if (null === $result) {
            throw new DataManagerException('User #'.$id.' not found');
        }

        return $this->mapRow($result);
    }

    /**
     * Mapping data from row to object
     *
     * @param array $row
     * @throws DataManagerException
     *
     * @return User
     */
    private function mapRow(array $row): User {

        try {
            $user = new User();
            $user->setFromArray($row);
            return $user;
        } catch (\InvalidArgumentException $e) {
            throw new DataManagerException($e);
        }
    }
}