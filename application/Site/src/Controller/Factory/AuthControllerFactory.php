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
use Site\Controller\AuthController;
use Site\Controller\Plugin\Factory\AuthPluginFactory;
use Site\Model\Service\Factory\AuthenticatorServiceFactory;

/**
 * Classe responsável por instanciar o controlador AuthController.
 */
class AuthControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return AuthController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new AuthController(
            $oApp,
            AuthenticatorServiceFactory::create($oApp)
        );
    }

}