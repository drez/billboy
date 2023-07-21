<?php

return [
    "action" =>
    [
        "list" => 'r',
        "view" => 'r',
        "create" => 'a',
        "update" => 'w',
        "delete" => 'd',
        "file" => 'a',
        "upload" => 'a',
        'doc' => 'r'
    ],
    "exclude" => [
        "/",
        "Authy/auth",
        "Authy/reset",
        "Authy/login",
        "Authy/logout"
    ]

];
