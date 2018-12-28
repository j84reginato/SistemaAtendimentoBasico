<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Plugin\Factory;

use Atendimento\Controller\Plugin\AuthPlugin;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o plugin AuthPlugin.
 */
class AuthPluginFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return AuthPlugin
     */
    public static function create(Application $oApp)
    {
        return new AuthPlugin($oApp);
    }

}