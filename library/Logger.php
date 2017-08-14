<?php

namespace library;

/**
 * Logger
 *
 * Implementa o registro de logs.
 * Esta classe irá implementar o Design Pattern Strategy.
 * Ou seja, uma família de algoritimos encapsulados em uma hierarquia de objetos.
 * Como esta é a superclasse, será uma classe abstrata contendo os métodos
 * que os algoritmos filhos devem prover.
 *
 * @author Jonatan Noronha Reginato
 */
abstract class Logger {

    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        file_put_contents($filename, '');
    }

    abstract function write($message);
}
