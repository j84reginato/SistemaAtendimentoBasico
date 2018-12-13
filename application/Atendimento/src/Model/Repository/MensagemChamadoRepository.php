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
use Myframework\Database\Filter;
use Myframework\Database\Join;
use Myframework\Database\Transaction;
use Myframework\Log\LoggerTXT;
use Myframework\Mvc\Model\Repository\Repository;

/**
 * Classe que define um repositório para operações com uma coleção de objetos.
 *
 *  - Banco de dados: atendimento.
 *  - Tabela: tb_mensagens_chamados.
 */
class MensagemChamadoRepository extends Repository
{
    /**
     * getMensagens.
     *
     * @param integer $iPkChamado
     * @return array
     */
    public function getMensagens($iPkChamado)
    {
        try {

            Transaction::open();
            Transaction::setLogger(new LoggerTXT('log_mensagem_chamado_repository.txt'));

            $oColumns = new Columns(
                'atendimento',
                'tb_mensagens_chamados',
                [
                    'mensagem',
                    'dataHora',
                ]
            );

            $oJoin = new Join();

            $oJoin->join(
                'atendimento.tb_usuarios AS tb_usuarios',
                'tb_mensagens_chamados.fkUsuario = tb_usuarios.pkUsuario',
                ['tb_usuarios.nome AS usuario'],
                Join::JOIN_INNER
            );

            $oCriteria = new Criteria();

            $oCriteria->add(new Filter('fkChamado', '=', (int) $iPkChamado));

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