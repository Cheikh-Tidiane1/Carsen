<?php

namespace App\Repository;

use App\Classe\SearchRent;
use App\Entity\VoitureLoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoitureLoc>
 *
 * @method VoitureLoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoitureLoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoitureLoc[]    findAll()
 * @method VoitureLoc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureLocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoitureLoc::class);
    }

    public function save(VoitureLoc $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VoitureLoc $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByWithSearchRent( SearchRent $searchRent)
    {
       $query = $this
           ->createQueryBuilder('v')
           ->select('t','v')
           ->join('v.typeVoiture','t');

       if(!empty($searchRent->typeVoiture))
       {
           $query = $query
               ->andWhere('t.id IN (:typeVoiture)')
               ->setParameter('typeVoiture',$searchRent->typeVoiture);
       }


       if(!empty($searchRent->dateDebut && $searchRent->dateFin))
       {
           $query = $query
               ->andWhere('v.dateDebutDispo <= :dateDebut and v.dateFinDispo >= :dateFin ')
             #  ->andWhere('v.dateFinDispo BETWEEN v:dateFin')
               #->andWhere('v.dateFinDispo >= :dateFin and v.dateFinDispo <= :dateFin')
               ->setParameter('dateDebut',$searchRent->dateDebut)
               ->setParameter('dateFin',$searchRent->dateFin);
       }

        return $query->getQuery()->getResult();
    }


//    /**
//     * @return VoitureLoc[] Returns an array of VoitureLoc objects
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

//    public function findOneBySomeField($value): ?VoitureLoc
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
