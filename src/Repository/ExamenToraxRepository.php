<?php

namespace App\Repository;

use App\Entity\ExamenTorax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

/**
 * @method ExamenTorax|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenTorax|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenTorax[]    findAll()
 * @method ExamenTorax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenToraxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenTorax::class);
    }
    public function findAllOrderedByCreadoEnDesc(HistorialClinico $historialClinico)
    {
        return $this->createQueryBuilder('q')
            ->where('q.historialClinico = :historialClinico')
            ->setParameter('historialClinico', $historialClinico)
            ->orderBy('q.creadoEn', 'DESC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }

    // Añade aquí métodos personalizados según sea necesario
}
