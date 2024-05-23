<?php

namespace App\Repository;

use App\Entity\Cita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cita[]    findAll()
 * @method Cita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cita::class);
    }

    public function findCitasDelDia(\DateTime $fecha)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.fechaCita BETWEEN :start AND :end')
            ->setParameter('start', $fecha->format('Y-m-d 00:00:00'))
            ->setParameter('end', $fecha->format('Y-m-d 23:59:59'))
            ->getQuery()
            ->getResult();
    }
}
