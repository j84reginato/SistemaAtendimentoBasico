<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Validator
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Validator;

use Exception;
use Myframework\Mvc\Model\Form\FormInterface;

/**
 * SessionValidator.
 */
class SessionValidator
{
    /**
     * validate.
     *
     * @param FormInterface $oSessionForm
     */
    public function validate(FormInterface $oSessionForm)
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') != 'POST') {
            throw new Exception("Ocorreu um erro inesperado");
        }
    }

}