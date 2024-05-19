<?php

namespace App\Repository;

use App\Entity\ExamenTorax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Añade aquí métodos personalizados según sea necesario
}
