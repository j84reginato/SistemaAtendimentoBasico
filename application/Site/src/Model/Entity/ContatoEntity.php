<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Entity
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Entity;

use Myframework\Mvc\Model\Entity\AbstractEntity;

/**
 * ContatoEntity.
 */
class ContatoEntity extends AbstractEntity
{
    const DB_SCHEMA = 'atendimento';
    const TABLE_NAME = 'tb_contatos';
    const PRIMARY_KEY = 'pkContato';
}