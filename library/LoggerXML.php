<?php

namespace library;

/**
 * LoggerXML
 *
 * Implementa o registro de logs em arquivo do tipo XML.
 * Classe filha de Logger (Design Pattern Strategy).
 *
 * @author Jonatan Noronha Reginato
 */
class LoggerXML extends Logger
{
    public function write($message) {
        date_default_timezone_get('America/Sao_Paulo');
        $time = date("Y-m-d H:i:s");

        // Monta o texto XML
        $text = "<log>/n";
        $text.= "   <time>$time</time>\n";
        $text.= "   <message>$message</message>\n";
        $text.= "</log>\n";

        // Adiciona ao final do arquivo
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}
