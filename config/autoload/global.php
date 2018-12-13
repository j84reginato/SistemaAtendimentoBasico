<?php

return [

    // Configurações para conexão ao BD.
    'db' => [
        'dbdriver' => 'PDO',
        'datatype' => 'mysql',
        'connport' => '3306',
        'hostname' => 'localhost',
        'database' => 'atendimento',
        'username' => 'root',
        'password' => '',
        'dbprefix' => '',
        'charset' => 'utf8',
    ],

    // Estratégia para registro de Log
    'log_strategy' => 'TXT'
];
