<?php

namespace App\Repository;

use App\Entity\CarteCrise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarteCrise>
 *
 * @method CarteCrise|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteCrise|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteCrise[]    findAll()
 * @method CarteCrise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteCriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteCrise::class);
    }

//    /**
//     * @return CarteCrise[] Returns an array of CarteCrise objects
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

//    public function findOneBySomeField($value): ?CarteCrise
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
