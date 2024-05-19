<?php

namespace App\Repository;

use App\Entity\Dieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Añade aquí métodos personalizados según sea necesario
}
