<?php

namespace App;

final class ProductType
{
    const DVD = 'dvd';

    const BOOK = 'book';

    const FURNITURE = 'furniture';

    public static function cases(): array
    {
        return [self::DVD, self::BOOK, self::FURNITURE];
    }

    public static function productAttributes(): array
    {
        return [
            self::DVD => ['size'],
            self::BOOK => ['weight'],
            self::FURNITURE => ['height', 'width', 'length']
        ];
    }

    public static function getAttributesOfType(string $type): array
    {
        if (!array_key_exists($type, self::productAttributes())) {
            return [];
        }

        return self::productAttributes()[$type];
    }
}
