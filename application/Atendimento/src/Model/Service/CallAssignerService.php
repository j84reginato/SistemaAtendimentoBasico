<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Service
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Service;

use Atendimento\Model\Entity\ChamadoEntity;
use Exception;
use j84Reginato\MyFramework\Database\Transaction;
use j84Reginato\MyFramework\Request\Request;
use Site\Model\Repository\UsuarioRepository;

/**
 * Serviço responsável por prover métodos para a atribuição de um chamado para
 * um atendente.
 */
class CallAssignerService
{
    /**
     * Método construtor.
     *
     * @param ChamadoEntity $oChamadoEntity
     * @param UsuarioRepository $oUsuarioRepository
     */
    public function __construct(
        ChamadoEntity $oChamadoEntity,
        UsuarioRepository $oUsuarioRepository
    )
    {
        $this->oChamadoEntity = $oChamadoEntity;
        $this->oUsuarioRepository = $oUsuarioRepository;
    }

    public function getAtendentes()
    {
        return $this->oUsuarioRepository->getAtendentes();
    }

    /**
     * Método responsável por realizar a abertura de um novo chamado.
     *
     * @param Request $oPost
     * @return array
     */
    public function assignCall($oPost)
    {
        try {
            Transaction::open();
            $oChamadoEntity = ChamadoEntity::find($oPost->pkChamado);
            $oChamadoEntity->fkAtendente = (int) $oPost->fkAtendente;
            $oChamadoEntity->fkStatusChamado = 2;
            $oChamadoEntity->store();
            Transaction::close(true);

            return [
                'status' => 'success',
                'message' => 'Chamado atribuído ao atendente com sucesso.'
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
