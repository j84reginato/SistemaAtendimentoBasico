<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Checker
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Checker;

use Exception;
use j84Reginato\MyFramework\Mvc\Model\Checker\CheckerInterface;
use j84Reginato\MyFramework\Mvc\Model\Form\FormInterface;

/**
 * MensagemChamadoChecker.
 */
class MensagemChamadoChecker implements CheckerInterface
{
    /**
     * check.
     *
     * @param FormInterface $oMensagemChamadoForm
     * @throws Exception
     */
    public function check(FormInterface $oMensagemChamadoForm)
    {
        if (empty($oMensagemChamadoForm->mensagem)) {
            throw new Exception("Por favor, informe a mensagem.");
        }
    }

}