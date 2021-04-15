<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 * @ORM\Entity()
 * @ORM\Table(name="library_card__book_events")
 */
class BookEventEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @var \Library\Circulation\Core\Book\Infrastructure\BookEntity
     * @ORM\ManyToOne(targetEntity="Library\Circulation\Core\Book\Infrastructure\BookEntity")
     */
    private BookEntity $emitter;

    /**
     * @var object
     * @ORM\Column(type="object")
     */
    private object $payload;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $class;

    /**
     * @var \Library\Circulation\Common\Domain\ValueObject\DateTime
     * @ORM\Column(type="custom_datetime")
     */
//    private DateTime $emittedAt;

    public function __construct(BookEntity $emitter, object $event)
    {
        $this->emitter = $emitter;
        $this->payload = $event;
        $this->class = $event::class;
//        $this->emittedAt = $emittedAt; TODO
    }
}
