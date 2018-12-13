<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service\Factory;

use Atendimento\Model\Checker\Factory\ChamadoCheckerFactory;
use Atendimento\Model\Entity\Factory\ChamadoEntityFactory;
use Atendimento\Model\Filter\Factory\ChamadoFilterFactory;
use Atendimento\Model\Form\Factory\ChamadoFormFactory;
use Atendimento\Model\Service\CallOpenerService;
use Atendimento\Model\Validator\Factory\ChamadoValidatorFactory;
use Myframework\Application\Application;

/**
 * Classe responsável por instanciar o serviço CallOpenerService.
 */
class CallOpenerServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return CallOpenerService
     */
    public static function create(Application $oApp)
    {
        return new CallOpenerService(
            ChamadoFormFactory::create($oApp),
            ChamadoEntityFactory::create($oApp),
            ChamadoCheckerFactory::create(),
            ChamadoFilterFactory::create(),
            ChamadoValidatorFactory::create()
        );
    }

}