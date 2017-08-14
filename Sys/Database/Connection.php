<?php

namespace sys\database;

/**
 * Connection
 *
 * Classe com métodos estáticos que realizam
 * uma conexão com o Banco de Dados via PDO
 *
 * @author Jonatan Noronha Reginato
 */
class Connection extends ConnectionConfig
{
    private static $error_supress = false;

    /**
     * __contruct
     *
     * Construtor do tipo protegido previne que uma nova instância da
     * classe seja criada através do operador "new" de fora dessa classe
     * (Design Pattern Singleton).
     */
    private function __construct() {}

    /**
     * open
     *
     * Este método realiza a conexão ao banco de dados com uso do driver PDO.
     * Usa o Design Pattern Factory para definir a escolha do tipo de BD (MySql ou Postgre, neste caso).
     */
    final public static function open()
    {
        switch (self::DB_TYPE) {
            case 'mysql':
                $conn_str = 'mysql:host='.self::DB_HOST.';port='.self::DB_PORT.';dbname='.self::DB_NAME.';charset='.self::DB_CHARSET;
                $conn = new \PDO($conn_str, self::DB_USER, self::DB_PASS);
                break;
            case 'pgsql':
                $conn_str = 'pgsql:dbname='.self::DB_NAME.';user='.self::DB_USER.';password='.self::DB_PASS.';'
                    . 'host='.self::DB_HOST.';port='.self::DB_PORT.';charset='.self::DB_CHARSET;
                $conn = new \PDO($conn_str);
                break;
        }
        try {
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            return $conn;
        } catch (\PDOException $e) {
            self::errorHandler($e->getMessage());
            exit();
        }
    }

    /**
     * errorSupress
     */
    final public static function errorSupress($state = true)
    {
        self::$error_supress = $state;
    }

    /**
     * errorHandler
     * Se o valor do atributo Database->error_supress for falso, imprime na tela a mensagem de erro.
     *
     * @param string $error - Mensagem de erro
     */
    final protected static function errorHandler($error)
    {
        if (!self::$error_supress) {
            print_r($error);
        }
    }
}
