<?php

namespace App\Repository;

use App\Entity\ExamenPelvico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\HistorialClinico;

/**
 * @method ExamenPelvico|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenPelvico|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenPelvico[]    findAll()
 * @method ExamenPelvico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenPelvicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenPelvico::class);
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
}
