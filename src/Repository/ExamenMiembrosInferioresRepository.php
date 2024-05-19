<?php

namespace App\Repository;

use App\Entity\ExamenMiembrosInferiores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExamenMiembrosInferiores|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenMiembrosInferiores|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenMiembrosInferiores[]    findAll()
 * @method ExamenMiembrosInferiores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenMiembrosInferioresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenMiembrosInferiores::class);
    }

    // Añade aquí métodos personalizados según sea necesario
}
