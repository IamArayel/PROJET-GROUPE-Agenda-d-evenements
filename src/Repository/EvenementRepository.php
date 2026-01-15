<?php

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    /**
     * @return Evenement[]
     */
    public function findEvenementsFuturs(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date >= :today')
            ->setParameter('today', new \DateTime('today'))
            ->orderBy('e.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Evenement[]
     */
    public function findFutursByCategorie(Categorie $categorie): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.relation = :categorie')
            ->andWhere('e.date >= :today')
            ->setParameter('categorie', $categorie)
            ->setParameter('today', new \DateTime('today'))
            ->orderBy('e.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
