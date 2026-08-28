<?php
namespace App\Utils;

class Sorting {
    public static function direction(string $col, string $currentSort, string $currentDir):string {
        if (!in_array($currentDir, ['asc', 'desc'])) {
            throw new \InvalidArgumentException("direction must be asc or desc, got: $currentDir");
        }

        return ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
    }

    public static function arrow(string $col, string $currentSort, string $currentDir):string {
        if (!in_array($currentDir, ['asc', 'desc'])) {
            throw new \InvalidArgumentException("direction must be asc or desc, got: $currentDir");
        }

        return $currentSort === $col ? ($currentDir === 'asc' ? '↑' : '↓') : '↑↓';
    }
}
