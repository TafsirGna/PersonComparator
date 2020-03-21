<?php

namespace App\Repository;

use App\Entity\DbOnePerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DbOnePerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method DbOnePerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method DbOnePerson[]    findAll()
 * @method DbOnePerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DbOnePersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DbOnePerson::class);
    }

    // /**
    //  * @return DbOnePerson[] Returns an array of DbOnePerson objects
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
    public function findOneBySomeField($value): ?DbOnePerson
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
