<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Cliente
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Controller\Factory;

use Atendimento\Controller\MensagemController;
use Atendimento\Controller\Plugin\Factory\AuthPluginFactory;
use Atendimento\Model\Service\Factory\MessageSenderServiceFactory;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o controlador MensagemController.
 */
class MensagemControllerFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return MensagemController
     */
    public static function create(Application $oApp)
    {
        AuthPluginFactory::create($oApp);

        return new MensagemController(
            $oApp,
            MessageSenderServiceFactory::create($oApp)
        );
    }

}