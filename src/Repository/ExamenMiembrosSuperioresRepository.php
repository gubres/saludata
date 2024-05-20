<?php

namespace App\Repository;

use App\Entity\ExamenMiembrosSuperiores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

/**
 * @method ExamenMiembrosSuperiores|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenMiembrosSuperiores|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenMiembrosSuperiores[]    findAll()
 * @method ExamenMiembrosSuperiores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenMiembrosSuperioresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenMiembrosSuperiores::class);
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
