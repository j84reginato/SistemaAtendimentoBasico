<?php

return [

    // Configurações de perfil de acesso.
    'permissoes' => [
        ADMINISTRADOR  => [
            'home',
            'ajuda',
            'chamado',
            'clientes',
            'configuracao',
            'relatorio'
        ],
        ATENDENTE => [
            'home',
            'ajuda',
            'chamado',
            'configuracao',
            'mensagem',
            'relatorio'
        ],
        CLIENTE => [
            'home',
            'ajuda',
            'chamado',
            'mensagem',
            'configuracao'
        ]
    ]
];
