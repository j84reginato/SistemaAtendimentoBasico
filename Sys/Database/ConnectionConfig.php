<?php

namespace sys\database;

abstract class ConnectionConfig
{
    // Configurações do Banco de Dados
    const DB_HOST       = 'localhost';
    const DB_NAME       = 'jnreg870_acessomedico';
    const DB_USER       = 'jnreg870';
    const DB_PASS       = 'bQO9269toc';
    const DB_TYPE       = 'mysql';
    const DB_PORT       = '3306';
    const DB_PREFIX     = 'acessomedico_';
    const DB_CHARSET    = 'utf8';

    // Token
    const MD5_PREFIX    = 'e2bfcf822acf92af27aab0d849c99bc4';

    // Google Calendar
    const GOOGLE_SYNC_FEATURE   = false;
    const GOOGLE_PRODUCT_NAME   = '';
    const GOOGLE_CLIENT_ID      = '';
    const GOOGLE_CLIENT_SECRET  = '';
    const GOOGLE_API_KEY        = '';
}
