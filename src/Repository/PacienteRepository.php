<?php

namespace App\Repository;

use App\Entity\Paciente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Paciente>
 *
 * @method Paciente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paciente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paciente[]    findAll()
 * @method Paciente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PacienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paciente::class);
    }
    public function findNotDeleted()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.eliminado = :val')
            ->setParameter('val', false)
            ->getQuery()
            ->getResult();
    }

    public function markAsDeleted($id)
    {
        $paciente = $this->find($id);
        if ($paciente) {
            $paciente->setEliminado(true);
            $em = $this->getEntityManager();
            $em->persist($paciente);
            $em->flush();
        }
    }

    //    /**
    //     * @return Paciente[] Returns an array of Paciente objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Paciente
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
