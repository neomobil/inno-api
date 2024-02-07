<?php

namespace App\Repository;

use App\Entity\UserCourseStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCourseStatus>
 *
 * @method UserCourseStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCourseStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCourseStatus[]    findAll()
 * @method UserCourseStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCourseStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCourseStatus::class);
    }

//    /**
//     * @return UserCourseStatus[] Returns an array of UserCourseStatus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserCourseStatus
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
