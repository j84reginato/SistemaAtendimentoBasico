<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Site
 * @category Service
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Site\Model\Service;

use Exception;
use Myframework\Database\Transaction;
use Site\Model\Checker\UsuarioChecker;
use Site\Model\Entity\UsuarioEntity;
use Site\Model\Filter\UsuarioFilter;
use Site\Model\Form\UsuarioForm;
use Site\Model\Validator\UsuarioValidator;

/**
 * Serviço responsável por prover métodos para se permitir o cadastro de um
 * novo usuário na aplicação.
 */
class UserRegistratorService
{
    /**
     * Método construtor.
     *
     * @param UsuarioForm $oUsuarioForm
     * @param UsuarioEntity $oUsuarioEntity
     * @param UsuarioChecker $oUsuarioChecker
     * @param UsuarioFilter $oUsuarioFilter
     * @param UsuarioValidator $oUsuarioValidator
     */
    public function __construct(
        UsuarioForm $oUsuarioForm,
        UsuarioEntity $oUsuarioEntity,
        UsuarioChecker $oUsuarioChecker,
        UsuarioFilter $oUsuarioFilter,
        UsuarioValidator $oUsuarioValidator
    )
    {
        $this->oUsuarioForm = $oUsuarioForm;
        $this->oUsuarioEntity = $oUsuarioEntity;
        $this->oUsuarioChecker = $oUsuarioChecker;
        $this->oUsuarioFilter = $oUsuarioFilter;
        $this->oUsuarioValidator = $oUsuarioValidator;
    }

    /**
     * Método responsável por realizar o cadastro de um novo usuário.
     *
     * @return array
     */
    public function register()
    {
        try {
            $this->oUsuarioChecker->check($this->oUsuarioForm);
            $this->oUsuarioFilter->filter($this->oUsuarioForm);
            $this->oUsuarioValidator->validate($this->oUsuarioForm);

            unset($this->oUsuarioForm->confirmarSenha);
            unset($this->oUsuarioForm->phrase);
            unset($this->oUsuarioForm->termsCheck);

            $this->passworHash();

            Transaction::open();
            $this->oUsuarioEntity->fromObject($this->oUsuarioForm);
            $this->oUsuarioEntity->store();
            Transaction::close(true);

            return [
                'status' => 'success',
                'message' => 'Usuário cadastrado com sucesso.'
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

    /**
     * Cria o hash da senha.
     *
     * @throws Exception
     */
    private function passworHash()
    {
        $this->oUsuarioForm->senha = password_hash(
            $this->oUsuarioForm->senha,
            PASSWORD_BCRYPT,
            ['cost' => 12]
        );
        if ($this->oUsuarioForm->senha === false) {
            throw new Exception('Falha ao realizar hash da senha.');
        }
    }

}
