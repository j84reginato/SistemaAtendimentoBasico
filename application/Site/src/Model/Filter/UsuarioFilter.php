<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Filter
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Filter;

use Myframework\Mvc\Model\Filter\FilterInterface;
use Myframework\Mvc\Model\Form\FormInterface;

/**
 * UsuarioFilter.
 */
class UsuarioFilter implements FilterInterface
{
    /**
     * filter.
     *
     * @param FormInterface $oUsuarioForm
     */
    public function filter(FormInterface $oUsuarioForm)
    {
        $oUsuarioForm->fkTipoUsuario = trim(filter_input(INPUT_POST, 'fkTipoUsuario', FILTER_SANITIZE_NUMBER_INT));
        $oUsuarioForm->nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $oUsuarioForm->usuario = trim(filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS));
        $oUsuarioForm->senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
        $oUsuarioForm->confirmarSenha = trim(filter_input(INPUT_POST, 'confirmarSenha', FILTER_SANITIZE_SPECIAL_CHARS));                
        $oUsuarioForm->email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    }

}