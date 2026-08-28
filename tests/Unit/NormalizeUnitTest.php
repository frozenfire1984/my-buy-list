<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Utils\Normalize;
use PHPUnit\Framework\Attributes\TestDox;

class NormalizeUnitTest extends TestCase
{
   #[TestDox('Если передать в Normalize::sorting price, то возвращается price')]
   public function test_valid_sort_by_price_passes_through():void {
       $this->assertEquals('price', Normalize::sorting('price'));
   }

    #[TestDox('Если передать в Normalize::sorting id, то возвращается id')]
    public function test_valid_sort_by_id_passes_through():void {
        $this->assertEquals('id', Normalize::sorting('id'));
    }

    #[TestDox('Если передать в Normalize::sorting ерунду, то по дефолту возвращает id')]
    public function test_invalid_sort_falls_back_to_id():void {
        $this->assertEquals('id', Normalize::sorting('lol'));
    }

    #[TestDox('Если передать в Normalize::sorting строку с элементами хаккерской атаки, то по дефолту возвращается id')]
    public function test_hack_sort_falls_back_to_id():void {
        $this->assertEquals('id', Normalize::sorting('DROP TABLE users'));
    }

    #[TestDox('Если ни чего не передать в Normalize::sorting, то по дефолту возвращается id')]
    public function test_null_sort_falls_back_to_id():void {
        $this->assertEquals('id', Normalize::sorting(null));
    }

    #[TestDox('Если передать в Normalize::direction desc, то возвращается desc')]
    public function test_valid_direction_desc_passes_through():void {
        $this->assertEquals('desc', Normalize::direction('desc'));
    }

    #[TestDox('Если ни чего не передать в Normalize::direction, то по дефолту возвращается asc')]
    public function test_null_direction_falls_back_to_asc():void {
        $this->assertEquals('asc', Normalize::direction(null));
    }

    #[TestDox('Если передать в Normalize::direction ерунду, то по дефолту возвращает asc')]
    public function test_invalid_direction_falls_back_to_asc():void {
        $this->assertEquals('asc', Normalize::direction('lol'));
    }
}
