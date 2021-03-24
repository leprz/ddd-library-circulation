<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Patron;

use Library\Circulation\Common\Application\Exception\InvalidArgumentException;

class PatronType
{
    private const UNDERGRADUATE_STUDENT = 'undergraduate_student';
    private const GRADUATE_STUDENT = 'graduate_student';
    private const FACULTY = 'faculty';
    private const STAFF = 'staff';
    private string $type;

    private function __construct(string $type)
    {
        $this->setRole($type);
    }

    private function setRole(string $type): void
    {
        self::assertRoleIsValid($type);

        $this->type = $type;
    }

    private static function assertRoleIsValid(string $type): void
    {
        if (!in_array($type, [self::UNDERGRADUATE_STUDENT, self::GRADUATE_STUDENT, self::FACULTY, self::STAFF])) {
            throw new InvalidArgumentException(
                sprintf('Role [%s] is invalid', $type)
            );
        }
    }

    public static function undergraduateStudent(): self
    {
        return new self(self::UNDERGRADUATE_STUDENT);
    }

    public static function graduateStudent(): self
    {
        return new self(self::GRADUATE_STUDENT);
    }

    public static function faculty(): self
    {
        return new self(self::FACULTY);
    }

    public static function staff(): self
    {
        return new self(self::STAFF);
    }

    public static function fromString(string $patronType): self
    {
        return match ($patronType) {
            self::FACULTY => self::faculty(),
            self::GRADUATE_STUDENT => self::graduateStudent(),
            self::UNDERGRADUATE_STUDENT => self::undergraduateStudent(),
            self::STAFF => self::staff(),
            default => throw new \InvalidArgumentException(
                sprintf('Unknown patron type [%s]', $patronType)
            )
        };
    }

    public function equals(PatronType $patronType): bool
    {
        return $this->type === $patronType->type;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
