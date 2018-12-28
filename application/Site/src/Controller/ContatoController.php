<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Controller
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller;

use j84Reginato\MyFramework\Application\Application;
use Site\Model\Service\ContactSenderService;

/**
 * Controlador que reune as ações para envio de mensagem direta (sem login).
 */
class ContatoController
{
    /**
     * Método contrutor.
     *
     * @param Application $oApp
     * @param ContactSenderService $oContactSenderService
     */
    public function __construct(
        Application $oApp,
        ContactSenderService $oContactSenderService
    )
    {
        $this->oApp = $oApp;
        $this->oContactSenderService = $oContactSenderService;
    }

    /**
     * Ação responsável pelo tratamento do envio de uma mensagem.
     */
    public function enviaAction()
    {
        $response = $this->oContactSenderService->sender();

        $oView = $this->oApp->getView();
        $oView->jsonView($response);
    }

}
