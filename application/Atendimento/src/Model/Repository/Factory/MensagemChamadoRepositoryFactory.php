<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Repository\Factory;

use Atendimento\Model\Entity\MensagemChamadoEntity;
use Atendimento\Model\Repository\MensagemChamadoRepository;
use j84Reginato\MyFramework\Application\Application;

/**
 * Classe responsável por instanciar o repositório MensagemChamadoRepository.
 */
class MensagemChamadoRepositoryFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return MensagemChamadoRepository
     */
    public static function create(Application $oApp)
    {
        return new MensagemChamadoRepository(MensagemChamadoEntity::class);
    }

}