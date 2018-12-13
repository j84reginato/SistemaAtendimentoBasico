<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Validator\Factory;

use Atendimento\Model\Validator\ChamadoValidator;

/**
 * Classe responsável por instanciar o serviço ChamadoValidator.
 */
class ChamadoValidatorFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return ChamadoValidator
     */
    public static function create()
    {
        return new ChamadoValidator();
    }

}