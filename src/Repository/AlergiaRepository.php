<?php

namespace App\Repository;

use App\Entity\Alergia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alergia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alergia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alergia[]    findAll()
 * @method Alergia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlergiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alergia::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}
