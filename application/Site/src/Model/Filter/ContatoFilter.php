<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Filter
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Filter;

use j84Reginato\MyFramework\Mvc\Model\Filter\FilterInterface;
use j84Reginato\MyFramework\Mvc\Model\Form\FormInterface;

/**
 * ContatoFilter.
 */
class ContatoFilter implements FilterInterface
{
    /**
     * filter.
     *
     * @param FormInterface $oContatoForm
     */
    public function filter(FormInterface $oContatoForm)
    {
        $oContatoForm->nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $oContatoForm->email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
        $oContatoForm->telefone = trim(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS));
        $oContatoForm->assunto = trim(filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS));
        $oContatoForm->mensagem = trim(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS));
    }

}