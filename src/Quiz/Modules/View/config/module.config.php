<?php
/**
 * View Module config
 */

return [
    'extension' => 'phtml',
    'layout' => 'src/Quiz/Application/view/layouts/%s.%s',
    'templates' => [
        'bootstrap' => [
            'index' => 'src/Quiz/Application/view/templates/%s/index.%s',
            'quiz_list' => 'src/Quiz/Application/view/templates/%s/quizzes/quiz_list.%s',
            'quiz_create' => 'src/Quiz/Application/view/templates/%s/quizzes/quiz_create.%s',
            'questions_list' => 'src/Quiz/Application/view/templates/%s/questions/questions_list.%s',
            'quest' => 'src/Quiz/Application/view/templates/%s/passing/quest.%s',
            'done' => 'src/Quiz/Application/view/templates/%s/passing/done.%s'
        ]
    ]
];