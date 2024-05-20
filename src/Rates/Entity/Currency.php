<?php

declare(strict_types=1);

namespace App\Rates\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Index(name: 'c_code_index', columns: ['code'])]
class Currency
{
    final public const string CODE_RUR = 'RUR';

    public function __construct(
        #[ORM\Id]
        #[ORM\Column]
        private string $id,
        #[ORM\Column()]
        public readonly  string $code,
        #[ORM\Column()]
        private string $name
    ) {
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}