<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Repository
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Repository;

use Exception;
use Myframework\Database\Columns;
use Myframework\Database\Criteria;
use Myframework\Database\Expression;
use Myframework\Database\Filter;
use Myframework\Database\Join;
use Myframework\Database\Transaction;
use Myframework\Log\LoggerTXT;
use Myframework\Mvc\Model\Repository\Repository;
use Site\Model\Form\SessionForm;

/**
 * Classe que define um repositório para operações com uma coleção de objetos.
 *
 *  - Banco de dados: atendimento.
 *  - Tabela: tb_usuarios.
 */
class UsuarioRepository extends Repository
{
    /**
     * getUserLogin.
     *
     * @return array
     */
    public function getUserLogin(SessionForm $oSessionForm)
    {
        try {

            Transaction::open();
            Transaction::setLogger(new LoggerTXT('log_usuario_repository.txt'));

            $oColumns = new Columns(
                'atendimento',
                'tb_usuarios',
                ['*']
            );

            $oJoin = new Join();

            // Condição 1
            $oCriteria1 = new Criteria();
            $oCriteria1->add(new Filter('usuario', '=', $oSessionForm->usuario));
            $oCriteria1->add(new Filter('email', '=', $oSessionForm->usuario), Expression::OR_OPERATOR);

            // Condição 2
            $oCriteria2 = new Criteria();
            $oCriteria2->add(new Filter('status', '=', 1));

            // Condição completa
            $oCriteria = new Criteria();
            $oCriteria->add($oCriteria1);
            $oCriteria->add($oCriteria2, Expression::AND_OPERATOR);

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
     * getAtendentes.
     *
     * @return array
     */
    public function getAtendentes()
    {
        try {
            Transaction::open();

            $oColumns = new Columns(
                constant($this->activeRecord . '::DB_SCHEMA'),
                constant($this->activeRecord . '::TABLE_NAME'),
                ['*']
            );
            $oJoin = new Join();
            $oCriteria = new Criteria();
            $oCriteria->add(new Filter('fkTipoUsuario', '=', 2));

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