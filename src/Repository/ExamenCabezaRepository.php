<?php

namespace App\Repository;

use App\Entity\ExamenCabeza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

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
