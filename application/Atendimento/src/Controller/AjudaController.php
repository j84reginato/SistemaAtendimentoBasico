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
 * AjudaController.
 */
class AjudaController
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

}
