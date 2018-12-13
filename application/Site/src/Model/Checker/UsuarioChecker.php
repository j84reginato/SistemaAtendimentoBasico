<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Checker
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Checker;

use Exception;
use Myframework\Mvc\Model\Checker\CheckerInterface;
use Myframework\Mvc\Model\Form\FormInterface;

/**
 * UsuarioChecker.
 */
class UsuarioChecker implements CheckerInterface
{
    /**
     * check.
     *
     * @param FormInterface $oUsuarioForm
     * @throws Exception
     */
    public function check(FormInterface $oUsuarioForm)
    {
        if (empty($oUsuarioForm->fkTipoUsuario)) {
            throw new Exception("Por favor, informe o tipo de usuário.");
        }

        if (empty($oUsuarioForm->nome)) {
            throw new Exception("Por favor, informe o seu nome completo.");
        }

        if (empty($oUsuarioForm->usuario)) {
            throw new Exception("Por favor, informe o nome de usuário.");
        }

        if (empty($oUsuarioForm->email)) {
            throw new Exception("Por favor, informe o seu email.");
        }

        if (empty($oUsuarioForm->senha)) {
            throw new Exception("Por favor, informe a sua senha.");
        }

        if (empty($oUsuarioForm->confirmarSenha)) {
            throw new Exception("Por favor, repita a sua senha no campo indicado.");
        }

        if (! $oUsuarioForm->termsCheck) {
            throw new Exception("Por favor, aceite os termos e condições.");
        }
    }

}