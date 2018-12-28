<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Controller
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller;

use Atendimento\Model\Service\MessageSenderService;
use j84Reginato\MyFramework\Application\Application;

/**
 * MensagemController.
 */
class MensagemController
{
    /**
     * Método contrutor.
     *
     * @param Application $oApp
     * @param MessageSenderService $oMessageSenderService
     */
    public function __construct(
        Application $oApp,
        MessageSenderService $oMessageSenderService
    )
    {
        $this->oApp = $oApp;
        $this->oMessageSenderService = $oMessageSenderService;
    }

    /**
     * Ação responsável pelo tratamento do envio de uma mensagem.
     */
    public function enviaAction()
    {
        $response = $this->oMessageSenderService->sender();

        $oView = $this->oApp->getView();
        $oView->jsonView($response);
    }

}
