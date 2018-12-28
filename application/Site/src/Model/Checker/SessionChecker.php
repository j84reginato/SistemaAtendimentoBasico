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
use j84Reginato\MyFramework\Mvc\Model\Checker\CheckerInterface;
use j84Reginato\MyFramework\Mvc\Model\Form\FormInterface;

/**
 * SessionChecker.
 */
class SessionChecker implements CheckerInterface
{
    /**
     * check.
     *
     * @param FormInterface $oSessionForm
     * @throws Exception
     */
    public function check(FormInterface $oSessionForm)
    {
        if (empty($oSessionForm->usuario)) {
            throw new Exception("Por favor, informe o nome de usuário.");
        }
        if (empty($oSessionForm->senha)) {
            throw new Exception("Por favor, informe a sua senha.");
        }
    }

}