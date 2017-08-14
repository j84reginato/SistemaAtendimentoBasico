<?php

namespace models;

use database\Connection;

/**
 * Connection
 *
 * Classe com métodos estáticos que realizam
 * o link (porta de entrada) da aplicação com o Banco de Dados
 *
 * @author Jonatan Noronha Reginato
 */
class Gateway
{
    private $last_query;
    private $fetch_query;
    private $fetch_methods = [
        'FETCH_CLASS' => \PDO::FETCH_CLASS,
        'FETCH_ASSOC' => \PDO::FETCH_ASSOC,
        'FETCH_BOTH' => \PDO::FETCH_BOTH,
        'FETCH_NUM' => \PDO::FETCH_NUM
    ];

    /**
     * directQuery
     *
     * Realiza uma consulta simples ao banco de dados.
     * Método utilizado quando se deseja realizar uma consulta sem a presença de parâmetros.
     *
     * @param string $query - A sql de consulta
     */
    public function directQuery($query)
    {
        try {
            $conn = Transaction::get();
            $this->last_query = $conn->query($query);
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
            return false;
        }
        return true;
    }

    /**
     * query
     *
     * Realiza a consulta ao banco de dados.
     * O parâmetro $query deve ser dado como: SELECT * FROM table WHERE this = :that AND where = :here
     * onde $params deverá ter os valores de :that e :here
     *
     * $params = array(
     *     array(':that', 'that value', PDO::PARAM_STR),
     *     array(':here', 'here value', PDO::PARAM_INT),
     * );
     * O último valor pode ser deixado em branco
     *
     * mais informações: http://php.net/manual/en/pdostatement.bindparam.php
     *
     * @param string $query - A string (sql) de consulta
     * @param array $params - Os parâmetros da consulta
     */
    public function query($query, $params = array())
    {
        try {
            $conn = Transaction::get();
            $setted_params = $this->setupParams($params);
            $cleaned_params = $this->cleanParams($query, $setted_params);
            $this->last_query = $conn->prepare($query);
            foreach ($cleaned_params as $val) {
                $this->last_query->bindParam($val[0], $val[1], $val[2]);
            }
            $this->last_query->execute();
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
            return false;
        }
        return true;
    }

    /**
     * fetch
     *
     * Procura e retorna (um a um) os resultados da consulta num array
     *
     * @param string $query - A string (sql) de consulta
     * @param string $method - Método de busca (padrão = FETCH_ASSOC)
     * @return array $data - Dados da consulta no formato:
     *                       $data['índice'] = valor
     *                       $data['nome do campo no bd'] = 'valor do campo no bd'
     */
    public function fetch($query = null, $method = 'FETCH_ASSOC')
    {
        try {
            if ($query == null) {
                if ($this->fetch_query == null) {
                    $this->fetch_query = $this->last_query;
                }
                $query = $this->fetch_query;
            }
            $data = $query->fetch($this->fetch_methods[$method]);
            if ($data == false) {
                $this->fetch_query = null;
            }
            return $data;
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * fetchObject
     *
     * Procura e retorna (um a um) os resultados da consulta num objeto stdClass
     *
     * @param string $query - A string (sql) de consulta
     * @return object $data - Dados da consulta no formato:
     *                        $objeto->atributo
     *                        $data['nome do campo no bd'] -> 'valor do campo no bd'
     */
    public function fetchObject($query = null)
    {
        try {
            if ($query == null) {
                if ($this->fetch_query == null) {
                    $this->fetch_query = $this->last_query;
                }
                $query = $this->fetch_query;
            }
            $data = $query->fetchObject();
            if ($data == false) {
                $this->fetch_query = null;
            }
            return $data;
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * fetchAll
     *
     * Procura e retorna os resultados da consulta (todos de uma vez) num array
     *
     * @param string $query
     * @param string $method
     * @return array()
     */
    public function fetchAll($query = null, $method = 'FETCH_ASSOC')
    {
        try {
            if ($query == null) {
                $query = $this->last_query;
            }
            return $query->fetchAll($this->fetch_methods[$method]);
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * fetchAllObject
     *
     * Procura e retorna os resultados da consulta (todos de uma vez) num objeto
     *
     * @param string $class
     * @param string $query
     * @return array()
     */
    public function fetchAllObject($class, $query = null)
    {
        try {
            if ($query == null) {
                $query = $this->last_query;
            }
            return $query->fetchAll(\PDO::FETCH_CLASS, $class);
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * result
     *
     * Procura e retorna (um a um) o valor de uma coluna específica do banco de dados
     *
     * @param string $column - A coluna do bd que se deseja retornar o valor
     * @param string $query - A string de consulta
     * @param string $method - O método de busca
     * @return array ou string - Retorna os dados da consulta
     */
    public function result($column = null, $query = null, $method = 'FETCH_ASSOC')
    {
        try {
            if ($query == null) {
                $query = $this->last_query;
            }
            $data = $query->fetch($this->fetch_methods[$method]);
            if (empty($column) || $column == null) {
                return $data;
            } else {
                return $data[$column];
            }
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * resultObject
     *
     * Procura e retorna (um a um) o valor de uma coluna específica do banco de dados
     *
     * @param string $column - A coluna do bd que se deseja retornar o valor
     * @param string $query - A string de consulta
     * @param string $method - O método de busca
     * @return object - Retorna os dados da consulta
     */
    public function resultObject($column = null, $query = null)
    {
        try {
            if ($query == null) {
                $query = $this->last_query;
            }
            $data = $query->fetchObject();
            if (empty($column) || $column == null) {
                return $data;
            } else {
                return $data->$column;
            }
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * numRows
     *
     * Conta o número de linhas encontradas pela consulta
     *
     * @param string $query - String da consulta
     * @return integer - Número de linhas retornadas pela consulta
     */
    public function numRows($query = null)
    {
        try {
            if ($query == null) {
                $query = $this->last_query;
            }
            return $query->rowCount();
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage() . ' ' . $query);
        }
    }

    /**
     * lastInsertId
     * Returna o id da última linha inserida na tabela
     *
     * @return integer - Valor do último id inserido
     */
    public function lastInsertId()
    {
        try {
            return $this->conn->lastInsertId();
        } catch (\PDOException $e) {
            Connection::errorHandler($e->getMessage());
        }
    }

    /**
     * setupParams
     * Define os valores PDO (PDO::PARAM_INT ou PDO::PARAM_STR) para os parâmetros
     * 1) Força a conversão para float se o parâmetro é do tipo float
     * 2) 'bool' => \PDO::PARAM_BOOL, não funciona, é um erro php.
     *    Para corrigir esse erro php, define 1 se o tipo for bool e se o valor for 1 ou mais.
     *
     * @param array $params - Parâmetros da consulta
     * @return array - Os parâmetros configurados com os valores PDO
     */
    final protected function setupParams($params)
    {
        $PDO_constants = array(
            'int' => \PDO::PARAM_INT,
            'str' => \PDO::PARAM_STR,
            'bool' => \PDO::PARAM_INT,
            'float' => \PDO::PARAM_STR
        );
        for ($i = 0; $i < count($params); $i++) {
            if ($params[$i][2] == 'float') {
                $params[$i][1] = floatval($params[$i][1]);
            }
            if ($params[$i][2] == 'bool' && $params[$i][1] > 1) {
                $params[$i][1] = 1;
            }
            $params[$i][2] = $PDO_constants[$params[$i][2]];
        }
        return $params;
    }

    /**
     * cleanParams
     * Encontra as variáveis definidas na consulta
     *
     * @param string $query
     * @param array $params - Parâmetros da consulta
     * @return array
     */
    final protected function cleanParams($query, $params)
    {
        preg_match_all("(:[a-zA-Z0-9_]+)", $query, $set_params = array());
        foreach ($set_params[0] as $val) {
            $key = $this->findKey($params, $val);
            if (isset($key)) {
                $new_params[] = $params[$key];
            }
        }
        return $new_params;
    }

    /**
     * findKey
     * Encontra as variáveis definidas na consulta
     *
     * @param array $params - Parâmetros da consulta
     * @param string $val - String procurada (:value)
     * @return integer
     */
    final protected function findKey($params, $val)
    {
        foreach ($params as $k => $v) {
            if ($v[0] == $val) {
                return $k;
            }
        }
    }
}
