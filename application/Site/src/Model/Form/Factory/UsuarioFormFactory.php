<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Form\Factory;

use j84Reginato\MyFramework\Application\Application;
use Site\Model\Form\UsuarioForm;

/**
 * Classe responsável por instanciar a entidade UsuarioForm.
 */
class UsuarioFormFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return UsuarioForm
     */
    public static function create(Application $oApp)
    {
        $oPost = $oApp->oRequest->getPost();
        $oUsuarioForm = new UsuarioForm($oPost);

        return $oUsuarioForm;
    }

}