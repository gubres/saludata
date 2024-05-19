<?php

namespace App\Repository;

use App\Entity\ResultadoPrueba;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResultadoPrueba|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultadoPrueba|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultadoPrueba[]    findAll()
 * @method ResultadoPrueba[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultadoPruebaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResultadoPrueba::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}