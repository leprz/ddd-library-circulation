<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Infrastructure;

use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Core\Patron\Domain\PatronId;

/**
 * @ORM\Entity()
 * @ORM\Table(name="patron")
 */
class PatronEntity
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private string $id;

    public function __construct(PatronId $id)
    {
        $this->id = (string)$id;
    }

    public function getId(): PatronId
    {
        return PatronId::fromString($this->id);
    }
}
