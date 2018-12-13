<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Factory;

use Atendimento\Controller\ChamadoController;
use Atendimento\Controller\Plugin\Factory\AuthPluginFactory;
use Atendimento\Model\Service\Factory\CallAssignerServiceFactory;
use Atendimento\Model\Service\Factory\CallLoaderServiceFactory;
use Atendimento\Model\Service\Factory\CallOpenerServiceFactory;
use Myframework\Application\Application;

/**
 * Classe responsável por instanciar o controlador ChamadoController.
 */
class ChamadoControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return ChamadoController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new ChamadoController(
            $oApp,
            CallOpenerServiceFactory::create($oApp),
            CallLoaderServiceFactory::create($oApp),
            CallAssignerServiceFactory::create($oApp)
        );
    }

}