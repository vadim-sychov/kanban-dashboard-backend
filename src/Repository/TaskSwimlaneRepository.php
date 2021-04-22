<?php

namespace App\Repository;

use App\Entity\TaskSwimlane;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskSwimlane|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskSwimlane|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskSwimlane[]    findAll()
 * @method TaskSwimlane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskSwimlaneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskSwimlane::class);
    }

    // /**
    //  * @return TaskSwimlane[] Returns an array of TaskSwimlane objects
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
    public function findOneBySomeField($value): ?TaskSwimlane
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
