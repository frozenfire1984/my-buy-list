<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Support\SortParams;
use PHPUnit\Framework\Attributes\TestDox;

class SortParamsTest extends TestCase
{
   #[TestDox('Если передать в normalizeSort price, то возвращается price')]
   public function test_valid_sort_by_price_passes_through():void {
       $this->assertEquals('price', SortParams::normalizeSort('price'));
   }

    #[TestDox('Если передать в normalizeSort id, то возвращается id')]
    public function test_valid_sort_by_id_passes_through():void {
        $this->assertEquals('id', SortParams::normalizeSort('id'));
    }

    #[TestDox('Если передать в normalizeSort ерунду, то по дефолту возвращает id')]
    public function test_invalid_sort_falls_back_to_id():void {
        $this->assertEquals('id', SortParams::normalizeSort('lol'));
    }

    #[TestDox('Если передать в normalizeSort строку с элементами хаккерской атаки, то по дефолту возвращается id')]
    public function test_hack_sort_falls_back_to_id():void {
        $this->assertEquals('id', SortParams::normalizeSort('DROP TABLE users'));
    }

    #[TestDox('Если ни чего не передать в normalizeSort, то по дефолту возвращается id')]
    public function test_null_sort_falls_back_to_id():void {
        $this->assertEquals('id', SortParams::normalizeSort(null));
    }

    #[TestDox('Если передать в normalizeDirection desc, то возвращается desc')]
    public function test_valid_direction_desc_passes_through():void {
        $this->assertEquals('desc', SortParams::normalizeDirection('desc'));
    }

    #[TestDox('Если ни чего не передать в normalizeDirection, то по дефолту возвращается asc')]
    public function test_null_direction_falls_back_to_asc():void {
        $this->assertEquals('asc', SortParams::normalizeDirection(null));
    }

    #[TestDox('Если передать в normalizeDirection ерунду, то по дефолту возвращает asc')]
    public function test_invalid_direction_falls_back_to_asc():void {
        $this->assertEquals('asc', SortParams::normalizeDirection('lol'));
    }
}
