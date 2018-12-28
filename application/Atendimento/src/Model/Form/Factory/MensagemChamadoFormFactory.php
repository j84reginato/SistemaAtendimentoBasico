<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Form\Factory;

use Atendimento\Model\Form\MensagemChamadoForm;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar a entidade MensagemChamadoForm.
 */
class MensagemChamadoFormFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return MensagemChamadoForm
     */
    public static function create(Application $oApp)
    {
        $oPost = $oApp->oRequest->getPost();
        $oMensagemChamadoForm = new MensagemChamadoForm($oPost);

        return $oMensagemChamadoForm;
    }

}