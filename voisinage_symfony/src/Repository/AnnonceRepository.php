<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonce>
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }
    public function findByCategorieLibelle(string $libelle):array{
        return $this->createQueryBuilder('a')
            ->where('a.c.libelle = :libelle')
            ->setParameter('libelle',$libelle)
            ->getQuery()
            ->getResult();
    }
    public function findByTypeTransaction(string $type_transaction):array{
        return $this->createQueryBuilder('a')
            ->where('a.type_transaction = :type_transaction')
            ->setParameter('type_transaction',$type_transaction)
            ->getQuery()
            ->getResult();
    }
    public function findByEtatObjet(string $etat_objet):array{
        return $this->createQueryBuilder('a')
            ->where('a.etat_objet = :etat_objet')
            ->setParameter('etat_objet',$etat_objet)
            ->getQuery()
            ->getResult();
    }
    public function findByPrix(string $prix){
        return $this->createQueryBuilder('a')
            ->where('a.prix = :prix')
            ->setParameter('prix',$prix)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Annonce[] Returns an array of Annonce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Annonce
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
