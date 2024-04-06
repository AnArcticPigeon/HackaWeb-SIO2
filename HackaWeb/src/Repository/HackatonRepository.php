<?php

namespace App\Repository;

use App\Entity\Hackaton;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hackaton>
 *
 * @method Hackaton|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hackaton|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hackaton[]    findAll()
 * @method Hackaton[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HackatonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hackaton::class);
    }

    public function getDateLimite(int $id) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT DateLimite(:id) AS DateLimite;';
        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        return $resultSet->fetchAssociative();
    }

    public function getNbInscrit(int $id) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT nbParticipant(:id) AS nbInscrit;';
        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        return $resultSet->fetchAssociative();
    }


//    public function findOneBySomeField($value): ?Hackaton
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
