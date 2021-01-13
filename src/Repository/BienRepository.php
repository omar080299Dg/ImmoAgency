<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    /**
     *@return Bien[]
     */
    public function findLatest() : array
    {
        return $this->createQueryBuilder('b')
            ->where('b.disponibilite = true')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }
    public function findByObjectif() : Query
    {
        return $this->createQueryBuilder('b')
            ->where('b.objectif = 0')
            ->andWhere('b.disponibilite = true')
            ->getQuery();
    }

    public function findByObjectifLocation() : Query
    {
        return $this->createQueryBuilder('b')
            ->where('b.objectif = 1')
            ->andWhere('b.disponibilite = true')
            ->getQuery();
    }
    // /**
    //  * @return Bien[] Returns an array of Bien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
