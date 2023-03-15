<?php

namespace App\Repository;

use App\Entity\Carte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Carte>
 *
 * @method Carte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carte[]    findAll()
 * @method Carte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carte::class);
    }

    public function save(Carte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Carte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Carte[] Returns an array of Carte objects public
     */
    public function findPublic(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.estPublique = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Carte[] Returns the first one
     */
    public function findRandomPublic(): array
    {
        try {
            $rd = random_int(1, 10);
        } catch (\Exception $e) {
            $rd = 1;
        }

        return $this->createQueryBuilder('c')
            ->andWhere('c.estPublique = :val')
            ->setParameter('val', 1)
            ->andWhere('c.id = :id')
            ->setParameter('id', $rd)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Carte[] Returns the first one
     */
    public function findRandomForUser(array $listecartes, array $listeToutesCartes): array
    {
        try {
            $rd = random_int(1, count($listeToutesCartes));
            while (in_array($rd, $listecartes)){
                $rd = random_int(1, count($listeToutesCartes));
            }
        } catch (\Exception $e) {
            $rd = 1;
        }

        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $rd)
            ->getQuery()
            ->getResult()
            ;
    }


//    public function findOneBySomeField($value): ?Carte
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
