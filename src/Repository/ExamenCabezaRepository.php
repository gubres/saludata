<?php

namespace App\Repository;

use App\Entity\ExamenCabeza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExamenCabeza|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenCabeza|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenCabeza[]    findAll()
 * @method ExamenCabeza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenCabezaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenCabeza::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}
