<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Validator\Factory;

use Site\Model\Validator\SessionValidator;

/**
 * Classe responsável por instanciar o serviço SessionValidator.
 */
class SessionValidatorFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return SessionValidator
     */
    public static function create()
    {
        return new SessionValidator();
    }

}