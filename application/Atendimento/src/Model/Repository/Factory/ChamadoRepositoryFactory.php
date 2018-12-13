<?php

/**
 * @package Sistema Atendimento Básico
 * @subpackage Atendimento
 * @category Factory
 * @version 1.0.0
 * @author Jonatan Noronha Reginato <noronha_reginato@hotmail.com>
 */
namespace Atendimento\Model\Repository\Factory;

use Myframework\Application\Application;
use Atendimento\Model\Entity\ChamadoEntity;
use Atendimento\Model\Repository\ChamadoRepository;

/**
 * Classe responsável por instanciar o repositório ChamadoRepository.
 */
class ChamadoRepositoryFactory
{
    /**
     * Método responsável por instanciar a classe solicitada.
     *
     * @param Application $oApp
     * @return ChamadoRepository
     */
    public static function create(Application $oApp)
    {
        return new ChamadoRepository(ChamadoEntity::class);
    }

}