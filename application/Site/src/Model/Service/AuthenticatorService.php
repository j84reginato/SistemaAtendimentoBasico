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
use Site\Model\Checker\SessionChecker;
use Site\Model\Filter\SessionFilter;
use Site\Model\Form\SessionForm;
use Site\Model\Repository\UsuarioRepository;
use Site\Model\Validator\SessionValidator;

/**
 * Serviço responsável por prover métodos para se permitir a autenticação de um
 * usuário à aplicação.
 */
class AuthenticatorService
{
    /**
     * Método construtor.
     *
     * @param SessionForm $oSessionForm
     * @param UsuarioRepository $oUsuarioRepository
     * @param SessionChecker $oSessionChecker
     * @param SessionFilter $oSessionFilter
     * @param SessionValidator $oSessionValidator
     */
    public function __construct(
        SessionForm $oSessionForm,
        UsuarioRepository $oUsuarioRepository,
        SessionChecker $oSessionChecker,
        SessionFilter $oSessionFilter,
        SessionValidator $oSessionValidator
    )
    {
        $this->oSessionForm = $oSessionForm;
        $this->oUsuarioRepository = $oUsuarioRepository;
        $this->oSessionChecker = $oSessionChecker;
        $this->oSessionFilter = $oSessionFilter;
        $this->oSessionValidator = $oSessionValidator;
    }

    /**
     * processLogin.
     */
    public function processLogin()
    {
        try {
            $this->oSessionChecker->check($this->oSessionForm);
            $this->oSessionFilter->filter($this->oSessionForm);
            $this->oSessionValidator->validate($this->oSessionForm);
            $this->dataVerification();
            $this->doAuth();
            return [
                'status' => 'success',
                'message' => 'Usuário autenticado com sucesso.'
            ];
        } catch (Exception $ex) {
            header("HTTP/1.0 400 Bad Request");
            return [
                'status' => 'danger',
                'message' => $ex->getMessage()
            ];
        }
    }

    /**
     * dataVerification
     */
    private function dataVerification()
    {
        $aResult = $this->oUsuarioRepository->getUserLogin($this->oSessionForm);
        $this->oUsuarioEntity = count($aResult) ? $aResult[0] : '';

        // Usuário não encontrado.
        if (! isset($this->oUsuarioEntity->senha)) {
            throw new Exception("Usuário não encontrado.");
        }

        // Senha incorreta.
        if (! password_verify($this->oSessionForm->senha, $this->oUsuarioEntity->senha)) {
            throw new Exception("Senha incorreta.");
        }

        // Usuário encontrado e senha correta.
        return $this->oUsuarioEntity;
    }

    /**
     * Processa a autenticação do usuário na aplicação e redireciona.
     */
    private function doAuth()
    {
        $_SESSION['csrfToken'] = md5(uniqid(rand(), true));
        $_SESSION['loggedUserId'] = $this->oUsuarioEntity->pkUsuario;
        $_SESSION['loggedUserName'] = $this->oUsuarioEntity->nome;
        $_SESSION['loggedUserType'] = $this->oUsuarioEntity->fkTipoUsuario;
    }

}
