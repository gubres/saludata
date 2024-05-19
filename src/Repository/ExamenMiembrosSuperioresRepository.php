<?php

namespace App\Repository;

use App\Entity\ExamenMiembrosSuperiores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Añade aquí métodos personalizados según sea necesario
}
