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
            'list' => 'src/Quiz/Application/view/templates/%s/list.%s',
            'create' => 'src/Quiz/Application/view/templates/%s/create.%s'
        ]
    ]
];