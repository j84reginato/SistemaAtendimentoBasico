<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Checker\Factory;

use Atendimento\Model\Checker\ChamadoChecker;

/**
 * Classe responsável por instanciar o serviço ChamadoChecker.
 */
class ChamadoCheckerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return ChamadoChecker
     */
    public static function create()
    {
        return new ChamadoChecker();
    }

}