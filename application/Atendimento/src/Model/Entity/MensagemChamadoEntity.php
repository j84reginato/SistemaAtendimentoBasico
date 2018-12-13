<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Entity
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Entity;

use Myframework\Mvc\Model\Entity\AbstractEntity;

/**
 * MensagemChamadoEntity.
 */
class MensagemChamadoEntity extends AbstractEntity
{
    const DB_SCHEMA = 'atendimento';
    const TABLE_NAME = 'tb_mensagens_chamados';
    const PRIMARY_KEY = 'pkMensagemChamado';
}