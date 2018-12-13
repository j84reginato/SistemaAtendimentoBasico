<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Filter\Factory;

use Site\Model\Filter\ContatoFilter;

/**
 * Classe responsável por instanciar o serviço ContatoFilter.
 */
class ContatoFilterFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return ContatoFilter
     */
    public static function create()
    {
        return new ContatoFilter();
    }

}