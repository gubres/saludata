<?php

namespace App\Repository;

use App\Entity\SignosVitales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

/**
 * @method SignosVitales|null find($id, $lockMode = null, $lockVersion = null)
 * @method SignosVitales|null findOneBy(array $criteria, array $orderBy = null)
 * @method SignosVitales[]    findAll()
 * @method SignosVitales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignosVitalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignosVitales::class);
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
