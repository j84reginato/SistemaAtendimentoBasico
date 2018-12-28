<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Factory;

use Atendimento\Controller\ConfiguracaoController;
use Atendimento\Controller\Plugin\Factory\AuthPluginFactory;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o controlador ConfiguracaoController.
 */
class ConfiguracaoControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return ConfiguracaoController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new ConfiguracaoController($oApp);
    }

}