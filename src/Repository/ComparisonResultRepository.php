<?php

namespace App\Repository;

use App\Entity\ComparisonResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComparisonResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComparisonResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComparisonResult[]    findAll()
 * @method ComparisonResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComparisonResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComparisonResult::class);
    }

    // /**
    //  * @return ComparisonResult[] Returns an array of ComparisonResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ComparisonResult
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
