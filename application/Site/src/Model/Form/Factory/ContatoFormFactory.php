<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Form\Factory;

use Myframework\Application\Application;
use Site\Model\Form\ContatoForm;

/**
 * Classe responsável por instanciar a entidade ContatoForm.
 */
class ContatoFormFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return ContatoForm
     */
    public static function create(Application $oApp)
    {
        $oPost = $oApp->oRequest->getPost();
        $oContatoForm = new ContatoForm($oPost);

        return $oContatoForm;
    }

}