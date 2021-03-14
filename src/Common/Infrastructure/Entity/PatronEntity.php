<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Common\Domain\Patron\PatronId;

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
