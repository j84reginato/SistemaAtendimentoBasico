<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Controller Plugin
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller\Plugin;

use Myframework\Application\Application;
use const APP_ROOT;

/**
 * Plugin responsável por verificar a autenticação do usuário.
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
        if ($this->oApp->oAuth->checkAuth()) {
            $this->redirectUser();
        }
    }

    /**
     * redirectUser.
     */
    private function redirectUser()
    {
        if (! $this->oApp->oAuth->checkLoginSession()) {
            header('location:' . APP_ROOT . 'site/home/index');
            exit();
        }
        header('location:' . APP_ROOT . 'atendimento/home/index');
        exit();
    }

}
