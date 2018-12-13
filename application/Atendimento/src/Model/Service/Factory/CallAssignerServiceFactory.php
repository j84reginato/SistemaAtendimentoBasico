<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service\Factory;

use Atendimento\Model\Entity\Factory\ChamadoEntityFactory;
use Atendimento\Model\Service\CallAssignerService;
use Myframework\Application\Application;
use Site\Model\Repository\Factory\UsuarioRepositoryFactory;

/**
 * Classe responsável por instanciar o serviço CallAssignerService.
 */
class CallAssignerServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return CallAssignerService
     */
    public static function create(Application $oApp)
    {
        return new CallAssignerService(
            ChamadoEntityFactory::create($oApp),
            UsuarioRepositoryFactory::create($oApp)
        );
    }

}