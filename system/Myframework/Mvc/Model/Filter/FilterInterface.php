<?php

/**
 * @package MyFramework
 * @subpackage MVC
 * @category Model/Filter
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Myframework\Mvc\Model\Filter;

use Myframework\Mvc\Model\Form\FormInterface;

/**
 * FilterInterface
 */
interface FilterInterface
{
    /**
     * filter.
     *
     * @param FormInterface $oForm
     */
    public function filter(FormInterface $oForm);
}