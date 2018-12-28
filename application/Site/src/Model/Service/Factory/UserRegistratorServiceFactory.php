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
use Site\Model\Checker\Factory\UsuarioCheckerFactory;
use Site\Model\Entity\Factory\UsuarioEntityFactory;
use Site\Model\Filter\Factory\UsuarioFilterFactory;
use Site\Model\Form\Factory\UsuarioFormFactory;
use Site\Model\Service\UserRegistratorService;
use Site\Model\Validator\Factory\UsuarioValidatorFactory;

/**
 * Classe responsável por instanciar o serviço UserRegistratorService.
 */
class UserRegistratorServiceFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return UserRegistratorService
     */
    public static function create(Application $oApp)
    {
        return new UserRegistratorService(
            UsuarioFormFactory::create($oApp),
            UsuarioEntityFactory::create($oApp),
            UsuarioCheckerFactory::create(),
            UsuarioFilterFactory::create(),
            UsuarioValidatorFactory::create()
        );
    }

}