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
use j84Reginato\MyFramework\Mvc\Model\Form\FormInterface;

/**
 * UsuarioValidator.
 */
class UsuarioValidator
{
    /**
     * validate.
     *
     * @param FormInterface $oUsuarioForm
     */
    public function validate(FormInterface $oUsuarioForm)
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') != 'POST') {
            throw new Exception("Ocorreu um erro inesperado");
        }

        if ((int) mb_strlen($oUsuarioForm->usuario) < 6) {
            throw new Exception("O nome de usuário deve conter no mínimo 6 caracteres.");
        }

        if ((int) mb_strlen($oUsuarioForm->senha) < 6) {
            throw new Exception("A senha deve conter no mínimo 6 caracteres.");
        }

        if ($oUsuarioForm->senha !== $oUsuarioForm->confirmarSenha) {
            throw new Exception("As senhas informadas não correspondem.");
        }

        if (! filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            throw new Exception("O endereço de email informado é inválido.");
        }

        if (! $this->testPhrase($oUsuarioForm->phrase)) {
            throw new Exception("Os caracteres informados não correspondem à imagem.");
        }
        unset($_SESSION['phrase']);
    }

    /**
     * testPhrase.
     *
     * @param string $userInput
     * @return boolean
     */
    private function testPhrase($userInput)
    {
        return ($this->niceize($userInput) == $this->niceize($this->getPhrase()));
    }

    /**
     * getPhrase.
     *
     * @return string
     */
    private function getPhrase()
    {
        return isset($_SESSION['phrase']) ? $_SESSION['phrase'] : '';
    }

    /**
     * niceize.
     *
     * @param string $str
     * @return string
     */
    private function niceize($str)
    {
        return strtr(strtolower($str), '01', 'ol');
    }

}