<?php

namespace App\Repository;

use App\Entity\Missatge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Missatge|null find($id, $lockMode = null, $lockVersion = null)
 * @method Missatge|null findOneBy(array $criteria, array $orderBy = null)
 * @method Missatge[]    findAll()
 * @method Missatge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissatgeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Missatge::class);
    }

    // /**
    //  * @return Missatge[] Returns an array of Missatge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Missatge
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
