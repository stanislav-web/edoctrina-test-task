<?php
/**
 * Question Module config
 */

return [
    'adapters' => [
        'MySQL' => [
            'host'              => 'localhost',
            'username'          => 'root',
            'password'          => 'root',
            'dbname'            => 'quiz',
            'port'              => 3306,
            'charset'           => 'utf8',
            'debug'             => \PDO::ERRMODE_EXCEPTION
        ]
    ]
];