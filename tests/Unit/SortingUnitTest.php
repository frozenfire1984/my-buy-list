<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Utils\Sorting;
use PHPUnit\Framework\Attributes\TestDox;

class SortingUnitTest extends TestCase
{
   #[TestDox('Если передать в Sorting::direction $col === $currentSort, и $currentDir === asc, то возвращается desc')]
   public function test_return_desc_if_col_equal_currentSort_and_currentDir_equal_asc():void {
       $this->assertEquals('desc', Sorting::direction('price', 'price', 'asc'));
   }

    #[TestDox('Если передать в Sorting::direction $col !== $currentSort, и $currentDir === asc, то возвращается asc')]
    public function test_return_asc_if_col_not_equal_currentSort_and_currentDir_equal_asc():void {
        $this->assertEquals('asc', Sorting::direction('price', 'name', 'asc'));
    }

    #[TestDox('Если передать в Sorting::direction $col === $currentSort, и $currentDir === desc, то возвращается asc')]
    public function test_return_asc_if_col_equal_currentSort_and_currentDir_equal_desc():void {
        $this->assertEquals('asc', Sorting::direction('price', 'price', 'desc'));
    }

    #[TestDox('Если передать в Sorting::direction $col !== $currentSort, и $currentDir === desc, то возвращается asc')]
    public function test_return_asc_if_col_not_equal_currentSort_and_currentDir_equal_desc():void {
        $this->assertEquals('asc', Sorting::direction('price', 'name', 'desc'));
    }

    #[TestDox('Если передать в $currentDir !== desc|asc, то выброситься исключение')]
    public function test_throws_when_invalid_currentDir():void {
        $this->expectException(\InvalidArgumentException::class);
        Sorting::direction('price', 'price', 'gladiolus');
    }

    #[TestDox('Если не передать $currentDir, то выброситься исключение')]
    public function test_throws_when_missing_currentDir_argument():void {
        $this->expectException(\ArgumentCountError::class);
        Sorting::direction('price', 'price');
    }

    #[TestDox('Если передать только $col, то выброситься исключение')]
    public function test_throws_when_missing_2st_and_3st_arguments():void {
        $this->expectException(\ArgumentCountError::class);
        Sorting::direction('price');
    }

    #[TestDox('Если вообще не передать аргументы, то выброситься исключение')]
    public function test_throws_when_missing_all_arguments():void {
        $this->expectException(\ArgumentCountError::class);
        Sorting::direction();
    }
}
