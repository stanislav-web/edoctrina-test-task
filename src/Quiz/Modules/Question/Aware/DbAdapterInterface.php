<?php
namespace Quiz\Modules\Question\Aware;

use Quiz\Modules\Question\Db\Exception\MySQLStorageException;

/**
 * Interface DbAdapterInterface
 * @package Quiz\Modules\Question\Aware
 */
interface DbAdapterInterface {

    /**
     * Connect to service
     *
     * @throws MySQLStorageException
     * @return \PDO
     */
    public function connect() : \PDO;

    /**
     * Disconnect from service
     *
     * @throws MySQLStorageException
     * @return bool
     */
    public function disconnect() : bool;

}