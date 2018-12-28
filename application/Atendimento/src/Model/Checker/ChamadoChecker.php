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
 * ChamadoChecker.
 */
class ChamadoChecker implements CheckerInterface
{
    /**
     * check.
     *
     * @param FormInterface $oChamadoForm
     * @throws Exception
     */
    public function check(FormInterface $oChamadoForm)
    {
        if (empty($oChamadoForm->fkMotivoChamado)) {
            throw new Exception("Por favor, informe o motivo do chamado.");
        }

        if (empty($oChamadoForm->fkTipoChamado)) {
            throw new Exception("Por favor, informe o tipo do chamado.");
        }

        if (empty($oChamadoForm->mensagem)) {
            throw new Exception("Por favor, escreva sua mensagem.");
        }
    }

}