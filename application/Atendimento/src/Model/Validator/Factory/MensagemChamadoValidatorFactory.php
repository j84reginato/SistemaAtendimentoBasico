<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Validator\Factory;

use Atendimento\Model\Validator\MensagemChamadoValidator;

/**
 * Classe responsável por instanciar o serviço MensagemChamadoValidator.
 */
class MensagemChamadoValidatorFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return MensagemChamadoValidator
     */
    public static function create()
    {
        return new MensagemChamadoValidator();
    }

}