<?php

namespace App\Repository;

use App\Entity\VatCalculationHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VatCalculationHistory>
 *
 * @method VatCalculationHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method VatCalculationHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method VatCalculationHistory[]    findAll()
 * @method VatCalculationHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VatCalculationHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VatCalculationHistory::class);
    }   

//    /**
//     * @return VatCalculationHistory[] Returns an array of VatCalculationHistory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VatCalculationHistory
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
