<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Entity\Factory;

use Site\Model\Entity\UsuarioEntity;

/**
 * Classe responsável por instanciar a entidade UsuarioEntity.
 */
class UsuarioEntityFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return UsuarioEntity
     */
    public static function create()
    {
        return new UsuarioEntity();
    }

}