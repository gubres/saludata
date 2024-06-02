<?php

namespace App\Repository;

use App\Entity\HistorialContrasena;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PasswordHistory>
 *
 * @method PasswordHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasswordHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasswordHistory[]    findAll()
 * @method PasswordHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistorialContrasenaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistorialContrasena::class);
    }
}
