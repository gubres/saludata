<?php

namespace App\Repository;

use App\Entity\Costumbres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

/**
 * @method Costumbres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Costumbres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Costumbres[]    findAll()
 * @method Costumbres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CostumbresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Costumbres::class);
    }
    public function findAllOrderedByCreadoEnDesc(HistorialClinico $historialClinico)
    {
        return $this->createQueryBuilder('q')
            ->where('q.historialClinico = :historialClinico')
            ->setParameter('historialClinico', $historialClinico)
            ->orderBy('q.creadoEn', 'DESC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
}
