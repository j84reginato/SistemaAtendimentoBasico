<?php

/**
 * @package MyFramework
 * @subpackage MVC
 * @category Model/Checker
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Myframework\Mvc\Model\Checker;

use Myframework\Mvc\Model\Form\FormInterface;

/**
 * CheckerInterface
 */
interface CheckerInterface
{
    /**
     * check.
     *
     * @param FormInterface $oForm
     */
    public function check(FormInterface $oForm);
}