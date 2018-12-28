<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service\Factory;

use Atendimento\Model\Checker\Factory\MensagemChamadoCheckerFactory;
use Atendimento\Model\Entity\Factory\MensagemChamadoEntityFactory;
use Atendimento\Model\Filter\Factory\MensagemChamadoFilterFactory;
use Atendimento\Model\Form\Factory\MensagemChamadoFormFactory;
use Atendimento\Model\Service\MessageSenderService;
use Atendimento\Model\Validator\Factory\MensagemChamadoValidatorFactory;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o serviço MessageSenderService.
 */
class MessageSenderServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return MessageSenderService
     */
    public static function create(Application $oApp)
    {
        return new MessageSenderService(
            MensagemChamadoFormFactory::create($oApp),
            MensagemChamadoEntityFactory::create($oApp),
            MensagemChamadoCheckerFactory::create(),
            MensagemChamadoFilterFactory::create(),
            MensagemChamadoValidatorFactory::create()
        );
    }

}