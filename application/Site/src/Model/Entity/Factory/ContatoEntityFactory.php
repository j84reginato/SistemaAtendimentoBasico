<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Entity\Factory;

use Site\Model\Entity\ContatoEntity;

/**
 * Classe responsável por instanciar a entidade ContatoEntity.
 */
class ContatoEntityFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return ContatoEntity
     */
    public static function create()
    {
        return new ContatoEntity();
    }

}