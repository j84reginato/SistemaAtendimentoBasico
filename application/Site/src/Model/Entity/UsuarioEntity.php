<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Entity
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Entity;

use j84Reginato\MyFramework\Mvc\Model\Entity\AbstractEntity;

/**
 * UsuarioEntity.
 */
class UsuarioEntity extends AbstractEntity
{
    const DB_SCHEMA = 'atendimento';
    const TABLE_NAME = 'tb_usuarios';
    const PRIMARY_KEY = 'pkUsuario';

}