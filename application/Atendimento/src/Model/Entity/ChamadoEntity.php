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
 * ChamadoEntity.
 */
class ChamadoEntity extends AbstractEntity
{
    const DB_SCHEMA = 'atendimento';
    const TABLE_NAME = 'tb_chamados';
    const PRIMARY_KEY = 'pkChamado';

    const CHAMADO_NOVO = 1;
    const CHAMADO_ATRIBUIDO = 2;
    const CHAMADO_CONCLUIDO = 3;
}