<?php

namespace App\Repository;

use App\Entity\ExamenAbdomen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExamenAbdomen|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenAbdomen|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenAbdomen[]    findAll()
 * @method ExamenAbdomen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenAbdomenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenAbdomen::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}