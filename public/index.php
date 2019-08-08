<?php

declare(strict_types=1);

use App\App;
use App\SessionBuilder;
use PommProject\Foundation\Pomm;

$loader = require __DIR__ . '/../vendor/autoload.php';

$pomm = new Pomm(
    [
        'pomm_issue' =>
            [
                'dsn'                   => 'pgsql://pomm_issue:pomm_issue@postgres:5432/pomm_issue',
                'class:session_builder' => SessionBuilder::class,
            ],
    ]
);

$app = new App($pomm);
dd($app());
