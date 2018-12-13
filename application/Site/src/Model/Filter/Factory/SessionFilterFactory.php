<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Filter\Factory;

use Site\Model\Filter\SessionFilter;

/**
 * Classe responsável por instanciar o serviço SessionFilter.
 */
class SessionFilterFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return SessionFilter
     */
    public static function create()
    {
        return new SessionFilter();
    }

}