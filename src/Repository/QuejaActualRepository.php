<?php

namespace App\Repository;

use App\Entity\QuejaActual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuejaActual|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuejaActual|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuejaActual[]    findAll()
 * @method QuejaActual[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuejaActualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuejaActual::class);
    }

    /**
     * @return QuejaActual[] Returns an array of QuejaActual objects ordered by creadoEn DESC
     */
    public function findAllOrderedByCreadoEnDesc()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.creadoEn', 'DESC')
            ->getQuery()
            ->getResult();
    }


    // Añade aquí métodos personalizados según sea necesario
}
