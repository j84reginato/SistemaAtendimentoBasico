<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Service
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service;

use Atendimento\Model\Checker\MensagemChamadoChecker;
use Atendimento\Model\Entity\MensagemChamadoEntity;
use Atendimento\Model\Filter\MensagemChamadoFilter;
use Atendimento\Model\Form\MensagemChamadoForm;
use Atendimento\Model\Validator\MensagemChamadoValidator;
use Exception;
use Myframework\Database\Transaction;

/**
 * Serviço responsável por prover métodos para se permitir o envio de uma
 * mensagem para contato sem a necessidade de login.
 */
class MessageSenderService
{
    /**
     * Método construtor.
     *
     * @param MensagemChamadoForm $oMensagemChamadoForm
     * @param MensagemChamadoEntity $oMensagemChamadoEntity
     * @param MensagemChamadoChecker $oMensagemChamadoChecker
     * @param MensagemChamadoFilter $oMensagemChamadoFilter
     * @param MensagemChamadoValidator $oMensagemChamadoValidator
     */
    public function __construct(
        MensagemChamadoForm $oMensagemChamadoForm,
        MensagemChamadoEntity $oMensagemChamadoEntity,
        MensagemChamadoChecker $oMensagemChamadoChecker,
        MensagemChamadoFilter $oMensagemChamadoFilter,
        MensagemChamadoValidator $oMensagemChamadoValidator
    )
    {
        $this->oMensagemChamadoForm = $oMensagemChamadoForm;
        $this->oMensagemChamadoEntity = $oMensagemChamadoEntity;
        $this->oMensagemChamadoChecker = $oMensagemChamadoChecker;
        $this->oMensagemChamadoFilter = $oMensagemChamadoFilter;
        $this->oMensagemChamadoValidator = $oMensagemChamadoValidator;
    }

    /**
     * Método responsável por realizar o envio de uma mensagem de contato.
     *
     * @return array
     */
    public function sender()
    {
        try {
            $this->oMensagemChamadoChecker->check($this->oMensagemChamadoForm);
            $this->oMensagemChamadoFilter->filter($this->oMensagemChamadoForm);
            $this->oMensagemChamadoValidator->validate($this->oMensagemChamadoForm);

            unset($this->oMensagemChamadoForm->csrfToken);

            Transaction::open();
            $this->oMensagemChamadoEntity->fromObject($this->oMensagemChamadoForm);
            $this->oMensagemChamadoEntity->store();
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
