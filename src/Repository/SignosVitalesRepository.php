<?php

namespace App\Repository;

use App\Entity\SignosVitales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Añade aquí métodos personalizados según sea necesario
}
