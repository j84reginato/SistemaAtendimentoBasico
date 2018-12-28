<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Factory;

use Atendimento\Controller\HomeController;
use Atendimento\Controller\Plugin\Factory\AuthPluginFactory;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o controlador HomeController.
 */
class HomeControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return HomeController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new HomeController($oApp);
    }

}