<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Controller
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Controller;

use j84Reginato\MyFramework\Application\Application;
use j84Reginato\MyFramework\Captcha\Captcha;

/**
 * Controlador que reune as ações responsáveis por configurar e inicializar a
 * página inicial da aplicação.
 */
class HomeController
{
    /**
     * Método construtor.
     *
     * @param Application $oApp
     */
    public function __construct(Application $oApp)
    {
        $this->oApp = $oApp;
    }

    /**
     * Configura e inicializa a página inicial.
     */
    public function indexAction()
    {
        $oCaptchaBuilderService = new Captcha();

        $oView = $this->oApp->getView();
        $oView->setData([
            'captcha' => $oCaptchaBuilderService
        ]);
        $oView->htmlView();
    }

}
