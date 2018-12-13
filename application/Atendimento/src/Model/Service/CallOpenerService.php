<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Service
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service;

use Atendimento\Model\Checker\ChamadoChecker;
use Atendimento\Model\Entity\ChamadoEntity;
use Atendimento\Model\Filter\ChamadoFilter;
use Atendimento\Model\Form\ChamadoForm;
use Atendimento\Model\Validator\ChamadoValidator;
use Exception;
use Myframework\Database\Transaction;

/**
 * Serviço responsável por prover métodos para a abertura de um chamado.
 */
class CallOpenerService
{
    /**
     * Método construtor.
     *
     * @param ChamadoForm $oChamadoForm
     * @param ChamadoEntity $oChamadoEntity
     * @param ChamadoChecker $oChamadoChecker
     * @param ChamadoFilter $oChamadoFilter
     * @param ChamadoValidator $oChamadoValidator
     */
    public function __construct(
        ChamadoForm $oChamadoForm,
        ChamadoEntity $oChamadoEntity,
        ChamadoChecker $oChamadoChecker,
        ChamadoFilter $oChamadoFilter,
        ChamadoValidator $oChamadoValidator
    )
    {
        $this->oChamadoForm = $oChamadoForm;
        $this->oChamadoEntity = $oChamadoEntity;
        $this->oChamadoChecker = $oChamadoChecker;
        $this->oChamadoFilter = $oChamadoFilter;
        $this->oChamadoValidator = $oChamadoValidator;
    }

    /**
     * Método responsável por realizar a abertura de um novo chamado.
     *
     * @return array
     */
    public function openCall()
    {
        try {
            $this->oChamadoChecker->check($this->oChamadoForm);
            $this->oChamadoFilter->filter($this->oChamadoForm);
            $this->oChamadoValidator->validate($this->oChamadoForm);

            unset($this->oChamadoForm->csrfToken);

            Transaction::open();
            $this->oChamadoEntity->fromObject($this->oChamadoForm);
            $this->oChamadoEntity->store();
            Transaction::close(true);

            return [
                'status' => 'success',
                'message' => 'Chamado aberto com sucesso.'
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
