<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Controller
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller;

use Myframework\Application\Application;
use Myframework\Captcha\Captcha;
use Site\Model\Service\UserRegistratorService;

/**
 * Controlador que reune as ações responsáveis pelo cadastro de um novo usuário.
 */
class UsuarioController
{
    /**
     * Método contrutor.
     *
     * @param Application $oApp
     * @param UserRegistratorService $oUserRegistratorService
     */
    public function __construct(
        Application $oApp,
        UserRegistratorService $oUserRegistratorService
    )
    {
        $this->oApp = $oApp;
        $this->oUserRegistratorService = $oUserRegistratorService;
    }

    /**
     * Ação responsável por gerar e exibir a página para cadastro de um novo
     * usuário na aplicação.
     */
    public function indexAction()
    {
        $oCaptchaBuilderService = new Captcha();
        $oCaptchaBuilderService->oCaptchaBuilder->build(300, 99);

        $oView = $this->oApp->getView();
        $oView->setData(['captcha' => $oCaptchaBuilderService]);
        $oView->htmlView();
    }

    /**
     * Ação responsável por processar o cadastro de um novo usuário.
     */
    public function saveAction()
    {
        $response = $this->oUserRegistratorService->register();

        $oView = $this->oApp->getView();
        $oView->jsonView($response);
    }

}
