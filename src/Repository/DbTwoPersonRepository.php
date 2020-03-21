<?php

namespace App\Repository;

use App\Entity\DbTwoPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DbTwoPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method DbTwoPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method DbTwoPerson[]    findAll()
 * @method DbTwoPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DbTwoPersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DbTwoPerson::class);
    }

    // /**
    //  * @return DbTwoPerson[] Returns an array of DbTwoPerson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DbTwoPerson
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
