<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Controller
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller;

use j84Reginato\MyFramework\Application\Application;

/**
 * Controlador que reune as ações responsáveis por configurar e inicializar a
 * página inicial do Cliente.
 */
class HomeController
{
    /**
     * Método construtor.
     *
     * @param Application $oApp
     */
    public function __construct(Application $oApp)
    {
        $this->oApp = $oApp;
    }

    /**
     * Configura e inicializa a página inicial.
     */
    public function indexAction()
    {
        $oView = $this->oApp->getView();
        $oView->htmlView();
    }

    /**
     * logoutAction
     */
    public function logoutAction()
    {
        unset($_SESSION['csrfToken']);
        unset($_SESSION['loggedUserId']);
        unset($_SESSION['loggedUserName']);
        unset($_SESSION['loggedUserType']);
        header('location:' . APP_ROOT . 'site/home/index');
        exit();
    }

}
