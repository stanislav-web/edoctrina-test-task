<?php
/**
 * Question Module config
 */

return [
    'quiz' => [
        'quiz_limit' => 30,
        'questions_limit' => 5,
    ],
    'adapters' => [
        'MySQL' => [
            'host'              => 'localhost',
            'username'          => 'root',
            'password'          => '123',
            'dbname'            => 'quiz',
            'port'              => 3306,
            'charset'           => 'utf8',
            'debug'             => \PDO::ERRMODE_EXCEPTION
        ]
    ]
];