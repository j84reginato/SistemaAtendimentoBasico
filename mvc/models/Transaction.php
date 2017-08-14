<?php

namespace models;

/**
 * Transaction
 *
 * Esta classe trata do processo de transação de registros no banco de dados (Transaction)
 * Não deve ser instanciada, pois possui somente atributos e métodos estáticos
 *
 * @author Jonatan Noronha Reginato
 */
final class Transaction
{
    private static $conn;
    private static $logger;

    /**
     * __contruct
     *
     * Construtor do tipo protegido previne que uma instância desta
     * classe seja criada através do operador "new" de fora dessa classe
     * (Design Pattern Singleton).
     */
    private function __construct() {}

    /**
     * open
     *
     * Inicia uma "transaction"
     * Faz uso do Design Pattern Singleton para não ser preciso realizar
     * novamente a conexão com o banco de dados (se já realizado uma vez),
     * quando for iniciado uma "transaction".
     */
    public static function open()
    {
        if (empty(self::$conn)) {
            self::$conn = Connection::open();
            self::$conn->beginTransaction();
            self::$logger = null;
        }
    }

    /**
     * close
     *
     * Finaliza uma "Transaction"
     * Se o parâmetro for "true" realiza um commit
     * Se o parâmetro for "false" realiza um rollback
     *
     * @param boolean $success
     */
    public static function close($success)
    {
        if (self::$conn) {
            if($success) {
                self::$conn->commit();
            } else {
                self::$conn->rollback();
            }
            self::$conn = null;
        }
    }

    /**
     * get
     *
     * Retorna o objeto PDO de conexão com o banco de dados
     *
     * @return object Objeto PDO
     */
    public static function get()
    {
        return self::$conn;
    }

    public static function log($message)
    {
        if (self::$logger) {
            self::$logger->write($message);
        }
    }
}
