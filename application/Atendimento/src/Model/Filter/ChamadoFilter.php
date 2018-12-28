<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Filter
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Filter;

use j84Reginato\MyFramework\Mvc\Model\Filter\FilterInterface;
use j84Reginato\MyFramework\Mvc\Model\Form\FormInterface;

/**
 * ChamadoFilter.
 */
class ChamadoFilter implements FilterInterface
{
    /**
     * filter.
     *
     * @param FormInterface $oChamadoForm
     */
    public function filter(FormInterface $oChamadoForm)
    {
        $oChamadoForm->fkMotivoChamado = filter_input(INPUT_POST, 'fkMotivoChamado', FILTER_SANITIZE_NUMBER_INT);
        $oChamadoForm->fkTipoChamado = filter_input(INPUT_POST, 'fkTipoChamado', FILTER_SANITIZE_NUMBER_INT);
        $oChamadoForm->mensagem = trim(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS));
    }

}