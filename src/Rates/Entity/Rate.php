<?php

declare(strict_types=1);

namespace App\Rates\Entity;

use App\Rates\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RateRepository::class)]
final readonly class Rate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\OneToOne]
    private Currency $currency;

    #[ORM\Column()]
    private string $value;

    #[ORM\OneToOne]
    private Currency $baseCurrency;

    public function __construct(
        #[ORM\Column()]
        public \DateTimeImmutable $date
    ) {
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->currency->toArray(),
            'base_currency' => $this->baseCurrency->toArray(),
            'value' => $this->value,
        ];
    }
}
