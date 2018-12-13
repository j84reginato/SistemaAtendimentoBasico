<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Service
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Service;

use Exception;
use Myframework\Database\Transaction;
use Site\Model\Checker\ContatoChecker;
use Site\Model\Entity\ContatoEntity;
use Site\Model\Filter\ContatoFilter;
use Site\Model\Form\ContatoForm;
use Site\Model\Validator\ContatoValidator;

/**
 * Serviço responsável por prover métodos para se permitir o envio de uma
 * mensagem para contato sem a necessidade de login.
 */
class ContactSenderService
{
    /**
     * Método construtor.
     *
     * @param ContatoForm $oContatoForm
     * @param ContatoEntity $oContatoEntity
     * @param ContatoChecker $oContatoChecker
     * @param ContatoFilter $oContatoFilter
     * @param ContatoValidator $oContatoValidator
     */
    public function __construct(
        ContatoForm $oContatoForm,
        ContatoEntity $oContatoEntity,
        ContatoChecker $oContatoChecker,
        ContatoFilter $oContatoFilter,
        ContatoValidator $oContatoValidator
    )
    {
        $this->oContatoForm = $oContatoForm;
        $this->oContatoEntity = $oContatoEntity;
        $this->oContatoChecker = $oContatoChecker;
        $this->oContatoFilter = $oContatoFilter;
        $this->oContatoValidator = $oContatoValidator;
    }

    /**
     * Método responsável por realizar o envio de uma mensagem de contato.
     *
     * @return array
     */
    public function sender()
    {
        try {
            $this->oContatoChecker->check($this->oContatoForm);
            $this->oContatoFilter->filter($this->oContatoForm);
            $this->oContatoValidator->validate($this->oContatoForm);

            unset($this->oContatoForm->phrase);

            Transaction::open();
            $this->oContatoEntity->fromObject($this->oContatoForm);
            $this->oContatoEntity->store();
            Transaction::close(true);

            return [
                'status' => 'success',
                'message' => 'Mensagem registrada com sucesso.'
            ];

        } catch (Exception $ex) {
            Transaction::close(false);
            header("HTTP/1.0 400 Bad Request");
            return [
                'status' => 'danger',
                'message' => $ex->getMessage()
            ];
        }
    }

}
