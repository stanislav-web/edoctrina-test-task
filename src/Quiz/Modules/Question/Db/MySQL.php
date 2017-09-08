<?php
namespace Quiz\Modules\Question\Db;

use Quiz\Modules\Question\Aware\DbAdapterInterface;
use Quiz\Modules\Question\Db\Exception\MySQLStorageException;

/**
 * Class MySQL
 * @package Quiz\Modules\Question\Db
 */
class MySQL implements DbAdapterInterface {

    /**
     * @var \stdClass $config
     */
    private $config;

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MySQL constructor.
     *
     * @param \stdClass $config
     */
    public function __construct(\stdClass $config) {

        $this->config['username'] = $config->username;
        $this->config['password'] = $config->password;
        $this->config['charset'] = $config->charset;
        $this->config['debug'] = $config->debug;
        $this->config['dsn'] = vsprintf('mysql:dbname=%s;host=%s;port=%d', [
            $config->dbname,
            $config->host,
            $config->port,
        ]);
    }

    /**
     * Connect to service
     *
     * @throws MySQLStorageException
     * @return \PDO
     */
    public function connect() : \PDO {

        if(null === $this->connection) {

            try {
                $this->connection = new \PDO($this->config['dsn'], $this->config['username'], $this->config['password'], [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '".$this->config['charset']."'",
                    \PDO::ATTR_CASE => \PDO::CASE_LOWER,
                    \PDO::ATTR_ERRMODE => $this->config['debug'],
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]);
            } catch (\PDOException $e) {
                throw new MySQLStorageException($e);
            }
        }

        return $this->connection;
    }

    /**
     * Disconnect from service
     *
     * @throws MySQLStorageException
     * @return bool
     */
    public function disconnect() : bool {

        if(null === $this->connection) {
            throw new MySQLStorageException('Connection already closed!');
        }

        $this->connection = null;

        return true;
    }
}