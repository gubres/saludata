<?php

namespace App\Repository;

use App\Entity\HistorialFamiliar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistorialClinico>
 *
 * @method HistorialClinico|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistorialClinico|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistorialClinico[]    findAll()
 * @method HistorialClinico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistorialFamiliarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistorialFamiliar::class);
    }

    //    /**
    //     * @return HistorialClinico[] Returns an array of HistorialFamiliar objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?HistorialFamiliar
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
