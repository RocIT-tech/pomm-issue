<?php

use App\SessionBuilder;
use PommProject\Foundation\Pomm;

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add(null, __DIR__);

return new Pomm(
    [
        'pomm_issue' =>
            [
                'dsn'                   => 'pgsql://pomm_issue:pomm_issue@postgres:5432/pomm_issue',
                'class:session_builder' => SessionBuilder::class,
            ],
    ]
);
