<?php

namespace App\Repository;

use App\Entity\ControleTech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ControleTech>
 *
 * @method ControleTech|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleTech|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleTech[]    findAll()
 * @method ControleTech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleTechRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControleTech::class);
    }

//    /**
//     * @return ControleTech[] Returns an array of ControleTech objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ControleTech
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
