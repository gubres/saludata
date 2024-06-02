<?php

namespace App\Repository;

use App\Entity\Dieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

/**
 * @method Dieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dieta[]    findAll()
 * @method Dieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DietaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dieta::class);
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
