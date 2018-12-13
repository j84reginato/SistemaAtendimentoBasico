<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Entity\Factory;

use Atendimento\Model\Entity\MensagemChamadoEntity;

/**
 * ChamadoEntityFactory.
 */
class MensagemChamadoEntityFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return ChamadoEntity
     */
    public static function create()
    {
        return new MensagemChamadoEntity();
    }

}