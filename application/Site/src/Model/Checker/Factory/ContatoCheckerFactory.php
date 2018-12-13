<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Checker\Factory;

use Site\Model\Checker\ContatoChecker;

/**
 * Classe responsável por instanciar o serviço ContatoChecker.
 */
class ContatoCheckerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return ContatoChecker
     */
    public static function create()
    {
        return new ContatoChecker();
    }

}