<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Filter\Factory;

use Atendimento\Model\Filter\MensagemChamadoFilter;

/**
 * Classe responsável por instanciar o serviço MensagemChamadoFilter.
 */
class MensagemChamadoFilterFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @return MensagemChamadoFilter
     */
    public static function create()
    {
        return new MensagemChamadoFilter();
    }

}