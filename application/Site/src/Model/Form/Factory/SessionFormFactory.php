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
use Site\Model\Form\SessionForm;

/**
 * Classe responsável por instanciar a entidade SessionForm.
 */
class SessionFormFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return SessionForm
     */
    public static function create(Application $oApp)
    {
        $oPost = $oApp->oRequest->getPost();
        $oSessionForm = new SessionForm($oPost);

        return $oSessionForm;
    }

}