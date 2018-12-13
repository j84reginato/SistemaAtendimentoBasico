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
use Atendimento\Model\Repository\ChamadoRepository;
use Atendimento\Model\Repository\MensagemChamadoRepository;
use Exception;
use const ADMINISTRADOR;
use const APP_ROOT;
use const CLIENTE;

/**
 * Serviço responsável por prover métodos para se permitir o carregamento dos
 * dados de um ou mais chamados.
 */
class CallLoaderService
{
    /**
     * @var string
     */
    private $sLabel;

    /**
     * @var integer
     */
    private $iTipo;

    /**
     * Método construtor.
     *
     * @param ChamadoRepository $oChamadoRepository
     */
    public function __construct(
        ChamadoRepository $oChamadoRepository,
        MensagemChamadoRepository $oMensagemChamadoRepository
    )
    {
        $this->oChamadoRepository = $oChamadoRepository;
        $this->oMensagemChamadoRepository = $oMensagemChamadoRepository;
    }

    /**
     * Recupera o valor do atributo.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->sLabel;
    }

    /**
     * Recupera o valor do atributo.
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->iTipo;
    }

    /**
     * Recupera uma listagem de chamados.
     *
     * @param string $sTipoListagem
     * @return array
     */
    public function getCalls($sTipoListagem = null)
    {
        switch ($sTipoListagem) {
            case 'novos' :
                if ($_SESSION['loggedUserType'] !== ADMINISTRADOR) {
                    header('location:' . APP_ROOT . 'atendimento/home/index');
                    exit();
                }
                $this->sLabel = 'Novos Chamados';
                $this->iTipo = ChamadoRepository::NOVOS_CHAMADOS;
                break;

            case 'atribuidos' :
                if ($_SESSION['loggedUserType'] === CLIENTE) {
                    header('location:' . APP_ROOT . 'atendimento/home/index');
                    exit();
                }
                $this->sLabel = 'Chamados Atribuídos';
                $this->iTipo = ChamadoRepository::CHAMADOS_ATRIBUIDOS;
                break;

            case 'abertos' :
                if ($_SESSION['loggedUserType'] !== CLIENTE) {
                    header('location:' . APP_ROOT . 'atendimento/home/index');
                    exit();
                }
                $this->sLabel = 'Chamados em Aberto';
                $this->iTipo = ChamadoRepository::CHAMADOS_ABERTOS;
                break;

            case 'concluidos' :
                $this->sLabel = 'Chamados Concluídos';
                $this->iTipo = ChamadoRepository::CHAMADOS_CONCLUIDOS;
                break;

            default :
                $this->sLabel = 'Todos os Chamados';
                $this->iTipo = ChamadoRepository::TODOS_OS_CHAMADOS;
                break;
        }

        return $this->oChamadoRepository->getCalls($this->iTipo);
    }

    /**
     * Recupera os dados de um determinado chamado.
     *
     * @param integer $iPkChamado
     * @return ChamadoEntity
     */
    public function getCall($iPkChamado)
    {
        $aChamado = $this->oChamadoRepository->getCall($iPkChamado);

        if (! is_array($aChamado) || ! count($aChamado)) {
            throw new Exception('Erro!');
        }

        $oChamadoEntity = $aChamado[0];
        $oChamadoEntity->mensagens = $this->oMensagemChamadoRepository->getMensagens($oChamadoEntity->pkChamado);

        return $oChamadoEntity;
    }

}
