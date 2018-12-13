<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Validator\Factory;

use Site\Model\Validator\UsuarioValidator;

/**
 * Classe responsável por instanciar o serviço UsuarioValidator.
 */
class UsuarioValidatorFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return UsuarioValidator
     */
    public static function create()
    {
        return new UsuarioValidator();
    }

}