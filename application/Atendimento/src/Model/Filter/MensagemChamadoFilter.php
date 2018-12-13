<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Filter
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Filter;

use Myframework\Mvc\Model\Filter\FilterInterface;
use Myframework\Mvc\Model\Form\FormInterface;

/**
 * MensagemChamadoFilter.
 */
class MensagemChamadoFilter implements FilterInterface
{
    /**
     * filter.
     *
     * @param FormInterface $oMensagemChamadoForm
     */
    public function filter(FormInterface $oMensagemChamadoForm)
    {
        $oMensagemChamadoForm->mensagem = trim(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS));
    }

}