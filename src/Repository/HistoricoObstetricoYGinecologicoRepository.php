<?php

namespace App\Repository;

use App\Entity\HistoricoObstetricoYGinecologico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoricoObstetricoYGinecologico|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoricoObstetricoYGinecologico|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoricoObstetricoYGinecologico[]    findAll()
 * @method HistoricoObstetricoYGinecologico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricoObstetricoYGinecologicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoricoObstetricoYGinecologico::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}
