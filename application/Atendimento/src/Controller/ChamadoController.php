<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Controller
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller;

use Atendimento\Model\Service\CallAssignerService;
use Atendimento\Model\Service\CallLoaderService;
use Atendimento\Model\Service\CallOpenerService;
use Myframework\Application\Application;
use const ADMINISTRADOR;
use const APP_ROOT;
use const CLIENTE;

/**
 * Controlador que reune as ações relativas aos chamados:
 *
 * - abrir chamado;
 * - listar chamados (novos, atribuídos, abertos, concluídos ou todos);
 * - atribuir um chamado a um atendente e
 * - apresentar os detalhes de um determinado chamado.
 */
class ChamadoController
{
    /**
     * Método construtor.
     *
     * @param Application $oApp
     * @param CallOpenerService $oCallOpenerService
     * @param CallLoaderService $oCallLoaderService
     * @param CallAssignerService $oCallAssignerService
     */
    public function __construct(
        Application $oApp,
        CallOpenerService $oCallOpenerService,
        CallLoaderService $oCallLoaderService,
        CallAssignerService $oCallAssignerService
    )
    {
        $this->oApp = $oApp;
        $this->oCallOpenerService = $oCallOpenerService;
        $this->oCallLoaderService = $oCallLoaderService;
        $this->oCallAssignerService = $oCallAssignerService;
    }

    /**
     * abrirAction.
     */
    public function abrirAction()
    {
        if ($_SESSION['loggedUserType'] !== CLIENTE) {
            header('location:' . APP_ROOT . 'atendimento/home/index');
            exit();
        }

        $oView = $this->oApp->getView();
        if ($this->oApp->oRequest->isPost()) {
            $response = $this->oCallOpenerService->openCall();
            $oView->jsonView($response);
        }
        $oView->htmlView();
    }

    /**
     * listarAction.
     */
    public function listarAction()
    {
        $oParams = $this->oApp->oController->getParams();
        $sTipoListagem = count($oParams) ? $oParams[0] : null;
        $response = $this->oCallLoaderService->getCalls($sTipoListagem);
        $oView = $this->oApp->getView();
        $oView->setData([
            'sLabel' => $this->oCallLoaderService->getLabel(),
            'iTipo' => $this->oCallLoaderService->getTipo(),
            'aChamados' => $response
        ]);
        $oView->htmlView();
    }

    /**
     * atribuirAction.
     */
    public function atribuirAction()
    {
        if ($_SESSION['loggedUserType'] !== ADMINISTRADOR) {
            header('location:' . APP_ROOT . 'atendimento/home/index');
            exit();
        }

        if ($this->oApp->oRequest->isPost()) {
            $oPost = $this->oApp->oRequest->getPost();            
            $response = $this->oCallAssignerService->assignCall($oPost);
            $oView = $this->oApp->getView();
            $oView->jsonView($response);
        }
    }

    /**
     * detalhesAction.
     */
    public function detalhesAction()
    {
        $this->oParams = $this->oApp->oController->getParams();
        $oChamadoEntity = $this->oCallLoaderService->getCall($this->oParams[0]);
        $aAtendentes = $this->oCallAssignerService->getAtendentes();

        $oView = $this->oApp->getView();
        $oView->setData([
            'oChamadoData' => $oChamadoEntity,
            'aAtendentes' => $aAtendentes
        ]);
        $oView->htmlView();
    }

}