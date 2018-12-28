<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller\Plugin\Factory;

use j84Reginato\MyFramework\Application\Application;
use Site\Controller\Plugin\AuthPlugin;

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