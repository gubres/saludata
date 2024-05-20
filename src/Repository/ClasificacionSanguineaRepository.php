<?php

namespace App\Repository;

use App\Entity\ClasificacionSanguinea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

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
    public function findAllOrderedByCreadoEnDesc(HistorialClinico $historialClinico)
    {
        return $this->createQueryBuilder('q')
            ->where('q.historialClinico = :historialClinico')
            ->setParameter('historialClinico', $historialClinico)
            ->orderBy('q.creadoEn', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    // Añade aquí métodos personalizados según sea necesario
}
