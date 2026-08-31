<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Utils\Sorting;
use PHPUnit\Framework\Attributes\TestDox;

class SortingArrowUnitTest extends TestCase
{
    #[TestDox('Sorting::arrow: если передать $col === $currentSort, и $currentDir === asc, то возвращается ↑')]
    public function test_arrow_return_arrow_up_if_col_equal_currentSort_and_currentDir_equal_asc():void {
        $this->assertEquals('↑', Sorting::arrow('price', 'price', 'asc'));
    }

    #[TestDox('Sorting::arrow: если передать в  $col === $currentSort, и $currentDir === desc, то возвращается ↓')]
    public function test_arrow_return_arrow_up_if_col_equal_currentSort_and_currentDir_equal_desc():void {
        $this->assertEquals('↓', Sorting::arrow('price', 'price', 'desc'));
    }

    #[TestDox('Sorting::arrow: если передать $col !== $currentSort, и $currentDir === desc, то возвращается ↑↓')]
    public function test_arrow_return_arrow_undetermined_if_col_not_equal_currentSort_and_currentDir_equal_desc():void {
        $this->assertEquals('↑↓', Sorting::arrow('price', 'id', 'desc'));
    }

    #[TestDox('Sorting::arrow: если передать $col !== $currentSort, и $currentDir === asc, то возвращается ↑↓')]
    public function test_arrow_return_arrow_undetermined_if_col_not_equal_currentSort_and_currentDir_equal_asc():void {
        $this->assertEquals('↑↓', Sorting::arrow('price', 'id', 'asc'));
    }

    #[TestDox('Sorting::arrow: если передать $currentDir !== desc|asc, то выброситься исключение')]
    public function test_arrow_throws_when_invalid_currentDir():void {
        $this->expectException(\InvalidArgumentException::class);
        Sorting::arrow('price', 'price', 'gladiolus');
    }

    #[TestDox('Sorting::arrow: если не передать $currentDir, то выброситься исключение')]
    public function test_arrow_throws_when_missing_currentDir_argument():void {
        $this->expectException(\ArgumentCountError::class);
        Sorting::arrow('price', 'price');
    }

    #[TestDox('Sorting::arrow: если передать только $col, то выброситься исключение')]
    public function test_arrow_throws_when_missing_2st_and_3st_arguments():void {
        $this->expectException(\ArgumentCountError::class);
        Sorting::arrow('price');
    }

    #[TestDox('Sorting::arrow: если вообще не передать аргументы, то выброситься исключение')]
    public function test_arrow_throws_when_missing_all_arguments():void {
        $this->expectException(\ArgumentCountError::class);
        Sorting::arrow();
    }
}
