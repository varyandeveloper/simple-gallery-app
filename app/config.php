<?php

return [
    'defaultController' => 'Home',
    'baseUrl' => '',
    'upload' => [
        "allowedTypes" => ['png','jpg','jpeg','sql'],
        "logoName" => "__VS__",
        "maxWidth" => 2048,
        "maxHeight" => 1536,
        "maxSize" => 5, // megabyte
        "uploadPath" => ROOT . "uploads" . DIRECTORY_SEPARATOR,
    ]
];