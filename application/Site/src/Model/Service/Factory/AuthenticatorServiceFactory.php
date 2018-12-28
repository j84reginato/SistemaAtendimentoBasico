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
use Site\Model\Checker\Factory\SessionCheckerFactory;
use Site\Model\Filter\Factory\SessionFilterFactory;
use Site\Model\Form\Factory\SessionFormFactory;
use Site\Model\Repository\Factory\UsuarioRepositoryFactory;
use Site\Model\Service\AuthenticatorService;
use Site\Model\Validator\Factory\SessionValidatorFactory;

/**
 * Classe responsável por instanciar o serviço AuthenticatorService.
 */
class AuthenticatorServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return AuthenticatorService
     */
    public static function create(Application $oApp)
    {
        return new AuthenticatorService(
            SessionFormFactory::create($oApp),
            UsuarioRepositoryFactory::create($oApp),
            SessionCheckerFactory::create(),
            SessionFilterFactory::create(),
            SessionValidatorFactory::create()
        );
    }

}