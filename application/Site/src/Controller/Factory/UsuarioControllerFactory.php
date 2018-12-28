<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller\Factory;

use j84Reginato\MyFramework\Application\Application;
use Site\Controller\Plugin\Factory\AuthPluginFactory;
use Site\Controller\UsuarioController;
use Site\Model\Service\Factory\UserRegistratorServiceFactory;

/**
 * Classe responsável por instanciar o controlador UsuarioController.
 */
class UsuarioControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return UsuarioController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new UsuarioController(
            $oApp,
            UserRegistratorServiceFactory::create($oApp)
        );
    }

}