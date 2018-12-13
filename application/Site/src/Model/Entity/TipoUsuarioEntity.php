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
 * TipoUsuarioEntity.
 */
class TipoUsuarioEntity extends AbstractEntity
{
    const DB_SCHEMA = 'atendimento';
    const TABLE_NAME = 'tb_tipos_usuario';
    const PRIMARY_KEY = 'pkTipoUsuario';

    const USUARIO_ADMINISTRADOR = 1;
    const USUARIO_ATENDENTE = 2;
    const USUARIO_CLIENTE = 3;
}