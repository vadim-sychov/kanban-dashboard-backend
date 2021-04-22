<?php

namespace App\Repository;

use App\Entity\TaskColumn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskColumn|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskColumn|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskColumn[]    findAll()
 * @method TaskColumn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskColumnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskColumn::class);
    }

    // /**
    //  * @return TaskColumn[] Returns an array of TaskColumn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TaskColumn
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
