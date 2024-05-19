<?php

namespace App\Repository;

use App\Entity\ClasificacionSanguinea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClasificacionSanguinea|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasificacionSanguinea|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasificacionSanguinea[]    findAll()
 * @method ClasificacionSanguinea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasificacionSanguineaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasificacionSanguinea::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}
