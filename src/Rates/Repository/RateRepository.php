<?php

declare(strict_types=1);

namespace App\Rates\Repository;

use App\Rates\Entity\Rate;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
    public function findByParams(\DateTimeImmutable $date, ?string $currency, string $baseCurrency): array
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->andWhere('r.baseCurrency = :val')
            ->setParameter('val', $baseCurrency)
            ->andWhere('r.date');

        if ($currency !== null) {
            $queryBuilder->andWhere('r.currency = :val')
                ->setParameter('val', $currency);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    private function getRecentDate(): string
    {
        return $this->createQueryBuilder('r')
            ->select($this->createQueryBuilder('r')->expr()->max('r.date'))
            ->getQuery()
            ->getResult();
    }
}