<?php

namespace App\Repository;

use App\Entity\Vacuna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vacuna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacuna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacuna[]    findAll()
 * @method Vacuna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacunaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacuna::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}
