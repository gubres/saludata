<?php

namespace App\Repository;

use App\Entity\Costumbres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Añade aquí métodos personalizados según sea necesario
}
