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
 * SessionFilter.
 */
class SessionFilter implements FilterInterface
{
    /**
     * filter.
     *
     * @param FormInterface $oSessionForm
     */
    public function filter(FormInterface $oSessionForm)
    {
        $oSessionForm->usuario = trim(filter_input(INPUT_POST, 'usuario'));
        $oSessionForm->senha = trim(filter_input(INPUT_POST, 'senha'));
    }

}