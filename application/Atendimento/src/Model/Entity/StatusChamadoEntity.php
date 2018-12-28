<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Entity
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Entity;

use j84Reginato\MyFramework\Mvc\Model\Entity\AbstractEntity;

/**
 * StatusChamadoEntity.
 */
class StatusChamadoEntity extends AbstractEntity
{
    const DB_SCHEMA = 'atendimento';
    const TABLE_NAME = 'tb_status_chamado';
    const PRIMARY_KEY = 'pkStatusChamado';
}