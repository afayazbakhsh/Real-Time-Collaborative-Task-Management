<?php

namespace App\Enums\Helpers;

use ErrorException;

trait EnumHelperTrait
{
    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

    /**
     * @throws ErrorException
     */
    public static function fromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        throw new ErrorException('The name of the case does not exist.');
    }

    /**
     * @throws ErrorException
     */
    public function __call(string $name, array $arguments): bool
    {
        $caseName = str($name)->after('is')->studly()->toString();

        return self::fromName($caseName)->value === $this->value;
    }
}
