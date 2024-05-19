<?php

namespace App\Repository;

use App\Entity\ExamenPelvico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Añade aquí métodos personalizados según sea necesario
}
