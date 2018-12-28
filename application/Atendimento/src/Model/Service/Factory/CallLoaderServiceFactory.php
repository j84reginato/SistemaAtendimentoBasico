<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service\Factory;

use Atendimento\Model\Repository\Factory\ChamadoRepositoryFactory;
use Atendimento\Model\Repository\Factory\MensagemChamadoRepositoryFactory;
use Atendimento\Model\Service\CallLoaderService;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o serviço CallLoaderService.
 */
class CallLoaderServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return CallLoaderService
     */
    public static function create(Application $oApp)
    {
        return new CallLoaderService(
            ChamadoRepositoryFactory::create($oApp),
            MensagemChamadoRepositoryFactory::create($oApp)
        );
    }

}