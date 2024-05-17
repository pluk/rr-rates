<?php

declare(strict_types=1);

namespace App\Rates\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Currency
{
    final public const string CODE_RUR = 'RUR';

    #[ORM\Id]
    #[ORM\Column]
    private string $id;

    #[ORM\Column()]
    private string $code;

    #[ORM\Column()]
    private string $name;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}