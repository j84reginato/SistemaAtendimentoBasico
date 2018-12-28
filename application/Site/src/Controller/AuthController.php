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
use j84Reginato\MyFramework\Captcha\Captcha;
use Site\Model\Service\AuthenticatorService;

/**
 * Controlador que reune as ações para a autenticação de um usuário à aplicação.
 */
class AuthController
{
    /**
     * Método contrutor.
     *
     * @param Application $oApp
     * @param AuthenticatorService $oAuthenticatorService
     */
    public function __construct(
        Application $oApp,
        AuthenticatorService $oAuthenticatorService
    )
    {
        $this->oApp = $oApp;
        $this->oAuthenticatorService = $oAuthenticatorService;
    }

    /**
     * Ação responsável por gerar e exibir a página de login.
     * Responsável também para processar o login do usuário.
     */
    public function indexAction()
    {
        $oView = $this->oApp->getView();

        if ($this->oApp->oRequest->isPost()) {
            $response = $this->oAuthenticatorService->processLogin();
            $oView->jsonView($response);
        }

        $oView->setData(['captcha' => new Captcha()]);
        $oView->htmlView();
    }

}
