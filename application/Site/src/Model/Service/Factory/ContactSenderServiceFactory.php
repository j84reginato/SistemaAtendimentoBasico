<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Service\Factory;

use j84Reginato\MyFramework\Application\Application;
use Site\Model\Checker\Factory\ContatoCheckerFactory;
use Site\Model\Entity\Factory\ContatoEntityFactory;
use Site\Model\Filter\Factory\ContatoFilterFactory;
use Site\Model\Form\Factory\ContatoFormFactory;
use Site\Model\Service\ContactSenderService;
use Site\Model\Validator\Factory\ContatoValidatorFactory;

/**
 * Classe responsável por instanciar o serviço ContactSenderService.
 */
class ContactSenderServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return ContactSenderServiceFactory
     */
    public static function create(Application $oApp)
    {
        return new ContactSenderService(
            ContatoFormFactory::create($oApp),
            ContatoEntityFactory::create($oApp),
            ContatoCheckerFactory::create(),
            ContatoFilterFactory::create(),
            ContatoValidatorFactory::create()
        );
    }

}