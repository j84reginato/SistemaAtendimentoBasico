<?php

namespace library;

/**
 * LoggerTXT
 *
 * Implementa o registro de logs em arquivo do tipo TXT.
 * Classe filha de Logger (Design Pattern Strategy).
 *
 * @author Jonatan Noronha Reginato
 */
class LoggerTXT extends Logger
{
    public function write($message) {
        date_default_timezone_get('America/Sao_Paulo');
        $time = date("Y-m-d H:i:s");

        // Monta a string
        $text = "$time :: $message";

        // Adiciona ao final do arquivo
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}
