<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Repository\Factory;

use Myframework\Application\Application;
use Site\Model\Entity\UsuarioEntity;
use Site\Model\Repository\UsuarioRepository;

/**
 * Classe responsável por instanciar o repositório UsuarioRepository.
 */
class UsuarioRepositoryFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return UsuarioRepository
     */
    public static function create(Application $oApp)
    {
        return new UsuarioRepository(UsuarioEntity::class);
    }

}