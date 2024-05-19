<?php

declare(strict_types=1);

namespace App\Rates\Entity;

use App\Rates\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RateRepository::class)]
#[ORM\Table(name: 'rates')]
#[ORM\UniqueConstraint(name: 'daily_rate', columns: ['currency_id', 'date'])]
class Rate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column()]
    public readonly string $value;

    public function __construct(
        #[ORM\Column(type: 'date')]
        public \DateTimeInterface $date,
        #[ORM\ManyToOne]
        private Currency $currency,
        string $value,
    ) {
        $this->value = str_replace(',', '.', $value);
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->currency->toArray(),
            'value' => $this->value,
        ];
    }
}
