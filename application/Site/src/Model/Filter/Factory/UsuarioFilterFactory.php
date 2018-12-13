<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Filter\Factory;

use Site\Model\Filter\UsuarioFilter;

/**
 * Classe responsável por instanciar o serviço UsuarioFilter.
 */
class UsuarioFilterFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return UsuarioFilter
     */
    public static function create()
    {
        return new UsuarioFilter();
    }

}