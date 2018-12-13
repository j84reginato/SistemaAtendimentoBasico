<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Validator
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Validator;

use Exception;
use Myframework\Mvc\Model\Form\FormInterface;

/**
 * MensagemChamadoValidator.
 */
class MensagemChamadoValidator
{
    /**
     * validate.
     *
     * @param FormInterface $oMensagemChamadoForm
     */
    public function validate(FormInterface $oMensagemChamadoForm)
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') != 'POST') {
            throw new Exception("Ocorreu um erro inesperado");
        }
    }

}