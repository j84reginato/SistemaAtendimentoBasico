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
use j84Reginato\MyFramework\Database\Columns;
use j84Reginato\MyFramework\Database\Criteria;
use j84Reginato\MyFramework\Database\Filter;
use j84Reginato\MyFramework\Database\Join;
use j84Reginato\MyFramework\Database\Transaction;
use j84Reginato\MyFramework\Log\LoggerTXT;
use j84Reginato\MyFramework\Mvc\Model\Repository\Repository;

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