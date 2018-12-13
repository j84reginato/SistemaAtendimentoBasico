<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller\Factory;

use Myframework\Application\Application;
use Site\Controller\HomeController;
use Site\Controller\Plugin\Factory\AuthPluginFactory;

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