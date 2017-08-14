<?php

namespace core;

class RememberMe {

    private $user_id;

    /**
     * Retorna o id do usuário na tabela remember_me de acordo com o parâmetro.
     *
     * @global \KdDoctor\classes\Database $objDb - Objeto conexão PDO
     * @param str $remember_code - Parâmetro remember_code do usuário procurado
     * @return str - Retorna o id do usuário
     */
    public function getUserId($remember_code)
    {
        global $objDb;

        $query = "SELECT user_id FROM " . DB_PREFIX . "remember_me WHERE remember_code = :remember_code";
        $params[] = array(':remember_code', $remember_code, 'str');
        $objDb->query($query, $params);
        if ($objDb->numRows() > 0) {
            $this->user_id = $objDb->result();
        }
        return $this->user_id;
    }
}
