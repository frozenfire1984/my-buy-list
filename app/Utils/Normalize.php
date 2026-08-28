<?php
namespace App\Utils;

class Normalize {
    public static function sorting(?string $sort): string {
        return in_array($sort, ['name', 'price', 'category']) ? $sort : 'id';
    }

    public static function direction(?string $direction): string {
        return in_array($direction, ['asc', 'desc']) ? $direction : 'asc';
    }