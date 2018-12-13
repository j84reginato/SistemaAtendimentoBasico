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
 * ContatoChecker.
 */
class ContatoChecker implements CheckerInterface
{
    /**
     * check.
     *
     * @param FormInterface $oContatoForm
     * @throws Exception
     */
    public function check(FormInterface $oContatoForm)
    {
        if (empty($oContatoForm->nome)) {
            throw new Exception("Por favor, informe o seu nome.");
        }

        if (empty($oContatoForm->email)) {
            throw new Exception("Por favor, informe o seu email.");
        }

        if (empty($oContatoForm->telefone)) {
            throw new Exception("Por favor, informe o seu telefone.");
        }

        if (empty($oContatoForm->assunto)) {
            throw new Exception("Por favor, informe o assunto de seu contato.");
        }

        if (empty($oContatoForm->mensagem)) {
            throw new Exception("Por favor, informe a mensagem.");
        }

        if (empty($oContatoForm->phrase)) {
            throw new Exception("Por favor, insira os caracteres do código indicado na imagem acima!");
        }
    }

}