<?php

namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    // /**
    //  * @return Cours[] Returns an array of Cours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cours
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // public function getCoursBycategorie($categorie)
    //         {
    //             return $this->createQueryBuilder('c')
    //                 ->andWhere('c.categorie = :categorie')
    //                 ->setParameter('categorie', $categorie)
    //                 // ->select('SUM(d.montant) as somme_montant')
    //                 ->getQuery()
    //                 ->getResult();
    //         }

            function findArray($array){

                return $this->createQueryBuilder('c')
                    ->andWhere('c.id IN(:array)')
                    ->setParameter('array', $array)
                    ->orderBy('c.id', 'ASC')
                    ->getQuery()
                    ->getResult();
            
            }
            function produitsByCategorie($categorie){
                return $this->createQueryBuilder('c')
                ->where('c.categorie = :categorie')
                ->andWhere('c.visibilite= 1')
                ->setParameter('categorie', $categorie)
                ->orderBy('c.id', 'ASC')
                ->getQuery()
                ->getResult();
                
            }
            
}
