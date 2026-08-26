<?php
namespace App\Support;

class SortParams
{
    public static function normalizeSort(?string $sort): string
    {
        return in_array($sort, ['name', 'price', 'category']) ? $sort : 'id';
    }

    public static function normalizeDirection(?string $direction): string
    {
        return in_array($direction, ['asc', 'desc']) ? $direction : 'asc';
    }
}
?>