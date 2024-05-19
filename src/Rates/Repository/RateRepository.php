<?php

declare(strict_types=1);

namespace App\Rates\Repository;

use App\Rates\Entity\Rate;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rate>
 */
class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    /**
     * @return array<Rate>
     */
    public function findLatestByParams(\DateTimeImmutable $date, ?string $currency): array
    {
        $queryBuilder = $this->createQueryBuilder('r');

        if ($currency !== null) {
            $queryBuilder->innerJoin('r.currency', 'c')
                ->andWhere('c.code = :currency')
                ->setParameter('currency', $currency);
        }

        $resultDate = $queryBuilder->andWhere('r.date = :date')
            ->setParameter('date', $date->format('Y-m-d'))
            ->getQuery()
            ->getResult();

        if ($resultDate === []) {
            $recentDate = $this->getRecentDate();

            $queryBuilder->andWhere('r.date = :date')
                ->setParameter('date', $recentDate);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return array<Rate>
     */
    public function findByParams(\DateTimeImmutable $date, string $currency): array
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->innerJoin('r.currency', 'c')
            ->andWhere('c.code = :currency')
            ->setParameter('currency', $currency)
            ->andWhere('r.date = :date')
            ->setParameter('date', $date->format('Y-m-d'));

        return $queryBuilder->getQuery()->getResult();
    }

    private function getRecentDate(): ?string
    {
        return $this->createQueryBuilder('r')
            ->select($this->createQueryBuilder('r')->expr()->max('r.date'))
            ->getQuery()
            ->getSingleScalarResult();
    }
}