<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Factory;

use Atendimento\Controller\Plugin\Factory\AuthPluginFactory;
use Atendimento\Controller\RelatorioController;
use Myframework\Application\Application;

/**
 * Classe responsável por instanciar o controlador RelatorioController.
 */
class RelatorioControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return RelatorioController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new RelatorioController($oApp);
    }

}