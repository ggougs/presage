<?php

namespace App\Repository;

use App\Entity\Avant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Avant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avant[]    findAll()
 * @method Avant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Avant::class);
    }

//    /**
//     * @return Avant[] Returns an array of Avant objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Avant
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
