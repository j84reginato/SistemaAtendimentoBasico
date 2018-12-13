<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Controller Plugin
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Plugin;

use Myframework\Application\Application;
use const APP_PATH;
use const APP_ROOT;

/**
 * Plugin responsável por verificar a autenticação e autorizações do usuário.
 */
class AuthPlugin
{
    /**
     * Método construtor.
     *
     * @param Application $oApp
     */
    public function __construct(Application $oApp)
    {
        $this->oApp = $oApp;

        $this->isAuthenticated();
        $this->isAuthorized();
    }

    /**
     * Método responsável por verificar se o usuário está logado no sistema.
     */
    private function isAuthenticated()
    {
        if (! $this->oApp->oAuth->checkAuth()) {
            header('location:' . APP_ROOT . 'site/auth/index');
            exit();
        }
    }

    /**
     * Verifica se o usuário tem permissão de acesso ao controller requisitado.
     */
    private function isAuthorized()
    {
        $aModuleConfig = require APP_PATH . 'Atendimento/config/config.php';
        $aPermissoes = $aModuleConfig['permissoes'][$_SESSION['loggedUserType']];
        $sController = $this->oApp->oView->sController;

        if (! in_array($sController, $aPermissoes) && $sController !== 'home') {
            header('location:' . APP_ROOT . 'atendimento/home/index');
            exit();
        }
    }

}
