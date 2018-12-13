<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Repository
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Repository;

use Exception;
use Myframework\Database\Columns;
use Myframework\Database\Criteria;
use Myframework\Database\Expression;
use Myframework\Database\Filter;
use Myframework\Database\Join;
use Myframework\Database\Transaction;
use Myframework\Log\LoggerTXT;
use Myframework\Mvc\Model\Repository\Repository;
use const ATENDENTE;
use const CLIENTE;

/**
 * Classe que define um repositório para operações com uma coleção de objetos.
 *
 *  - Banco de dados: atendimento.
 *  - Tabela: tb_chamados.
 */
class ChamadoRepository extends Repository
{
    /**
     * Todos os chamados.
     */
    const TODOS_OS_CHAMADOS = 1000;

    /**
     * Novos chamados abertos e que ainda não foram atribuídos a um atendente.
     */
    const NOVOS_CHAMADOS = 1001;

    /**
     * Chamados atribuídos a um atendente.
     */
    const CHAMADOS_ATRIBUIDOS = 1002;

    /**
     * Chamados que já foram concluídos.
     */
    const CHAMADOS_CONCLUIDOS = 1003;

    /**
     * Representam os chamados novos + atribuídos.
     */
    const CHAMADOS_ABERTOS = 1004;

    /**
     * getCall.
     *
     * @param integer $iPkChamado
     * @return array
     */
    public function getCall($iPkChamado)
    {
        try {

            Transaction::open();
            Transaction::setLogger(new LoggerTXT('log_chamado_repository.txt'));

            $oColumns = new Columns(
                'atendimento',
                'tb_chamados',
                [
                    'pkChamado',
                    'mensagem',
                    'dataHoraAbertura',
                    'dataHoraFechamento',
                ]
            );

            $oJoin = new Join();

            $oJoin->join(
                'atendimento.tb_usuarios AS tb_clientes',
                'tb_chamados.fkCliente = tb_clientes.pkUsuario',
                ['tb_clientes.nome AS cliente'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_usuarios AS tb_atendentes',
                'tb_chamados.fkAtendente = tb_atendentes.pkUsuario',
                ['tb_atendentes.nome AS atendente'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_motivos_chamado',
                'tb_chamados.fkMotivoChamado = tb_motivos_chamado.pkMotivoChamado',
                ['tb_motivos_chamado.descricao AS motivo'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_tipos_chamado',
                'tb_chamados.fkTipoChamado = tb_tipos_chamado.pkTipoChamado',
                ['tb_tipos_chamado.descricao AS tipo'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_status_chamado',
                'tb_chamados.fkStatusChamado = tb_status_chamado.pkStatusChamado',
                ['tb_status_chamado.descricao AS status'],
                Join::JOIN_INNER
            );

            $oCriteria = new Criteria();

            $oCriteria->add(new Filter('pkChamado', '=', (int) $iPkChamado));

            if ($_SESSION['loggedUserType'] === ATENDENTE) {
                $oCriteria->add(new Filter('fkAtendente', '=', $_SESSION['loggedUserId']), Expression::AND_OPERATOR);
            }
            if ($_SESSION['loggedUserType'] === CLIENTE) {
                $oCriteria->add(new Filter('fkCliente', '=', $_SESSION['loggedUserId']), Expression::AND_OPERATOR);
            }

            return $this->load($oColumns, $oJoin, $oCriteria);

        } catch (Exception $ex) {
            header("HTTP/1.0 400 Bad Request");
            return [
                'status' => 'danger',
                'message' => $ex->getMessage()
            ];
        }
    }

    /**
     * getCalls.
     *
     * @param integer $type
     * @return array
     */
    public function getCalls($type = self::TODOS_OS_CHAMADOS)
    {
        try {

            Transaction::open();
            Transaction::setLogger(new LoggerTXT('log_chamado_repository.txt'));

            $oColumns = new Columns(
                'atendimento',
                'tb_chamados',
                [
                    'pkChamado',
                    'mensagem',
                    'dataHoraAbertura',
                    'dataHoraFechamento',
                ]
            );

            $oJoin = new Join();

            $oJoin->join(
                'atendimento.tb_usuarios AS tb_clientes',
                'tb_chamados.fkCliente = tb_clientes.pkUsuario',
                ['tb_clientes.nome AS cliente'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_usuarios AS tb_atendentes',
                'tb_chamados.fkAtendente = tb_atendentes.pkUsuario',
                ['tb_atendentes.nome AS atendente'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_motivos_chamado',
                'tb_chamados.fkMotivoChamado = tb_motivos_chamado.pkMotivoChamado',
                ['tb_motivos_chamado.descricao AS motivo'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_tipos_chamado',
                'tb_chamados.fkTipoChamado = tb_tipos_chamado.pkTipoChamado',
                ['tb_tipos_chamado.descricao AS tipo'],
                Join::JOIN_INNER
            );

            $oJoin->join(
                'atendimento.tb_status_chamado',
                'tb_chamados.fkStatusChamado = tb_status_chamado.pkStatusChamado',
                ['tb_status_chamado.descricao AS status'],
                Join::JOIN_INNER
            );

            $oCriteria = new Criteria();

            if ($type === self::NOVOS_CHAMADOS) {
                $oCriteria->add(new Filter('fkStatusChamado', '=', 1));
            }
            if ($type === self::CHAMADOS_ATRIBUIDOS) {
                $oCriteria->add(new Filter('fkStatusChamado', '=', 2));
            }
            if ($type === self::CHAMADOS_CONCLUIDOS) {
                $oCriteria->add(new Filter('fkStatusChamado', '=', 3));
            }
            if ($type === self::CHAMADOS_ABERTOS) {
                $oCriteria->add(new Filter('fkStatusChamado', '<>', 3));
            }
            if ($_SESSION['loggedUserType'] === ATENDENTE) {
                $oCriteria->add(new Filter('fkAtendente', '=', $_SESSION['loggedUserId']), Expression::AND_OPERATOR);
            }
            if ($_SESSION['loggedUserType'] === CLIENTE) {
                $oCriteria->add(new Filter('fkCliente', '=', $_SESSION['loggedUserId']), Expression::AND_OPERATOR);
            }

            $oCriteria->setProperty('order', 'dataHoraAbertura');

            return $this->load($oColumns, $oJoin, $oCriteria);

        } catch (Exception $ex) {
            header("HTTP/1.0 400 Bad Request");
            return [
                'status' => 'danger',
                'message' => $ex->getMessage()
            ];
        }
    }

}