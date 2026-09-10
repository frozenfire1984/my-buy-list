<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Utils\Text;
use PHPUnit\Framework\Attributes\TestDox;

class TextUnitTest extends TestCase
{
   #[TestDox('Text::capitalize: если передать слово на английском, "laravel", то возвращается кап-е "Laravel"')]
   public function test_capitalize_english_word():void {
       $this->assertEquals('Laravel', Text::capitalize('laravel'));
   }

    #[TestDox('Text::capitalize: если передать слово на русском, "ларавел", то возвращается кап-е "Ларавел"')]
    public function test_capitalize_russian_word():void {
        $this->assertEquals('Ларавел', Text::capitalize('ларавел'));
    }

    #[TestDox('Text::capitalize: если передать слово на английском, "laraVeL", то возвращается кап-е "Laravel"')]
    public function test_capitalize_english_word_with_reset_params():void {
        $this->assertEquals('Laravel', Text::capitalize('laraVeL', is_reset: true));
    }

    #[TestDox('Text::capitalize: если передать слово на английском, "лараВеЛ", то возвращается кап-е "Ларавел"')]
    public function test_capitalize_russian_word_with_reset_params():void {
        $this->assertEquals('Ларавел', Text::capitalize('лараВеЛ', is_reset: true));
    }

    #[TestDox('Text::capitalize: если передать предложение на английском, "laravel is cool", то возвращается кап-е "Laravel is cool"')]
    public function test_capitalize_english_sense():void {
        $this->assertEquals('Laravel is cool', Text::capitalize('laravel is cool'));
    }

    #[TestDox('Text::capitalize: если передать предложение на английском, "laravel is cool" с п-м is_each_word, то возвращается кап-е "Laravel Is Cool"')]
    public function test_capitalize_english_sense_with_is_each_word():void {
        $this->assertEquals('Laravel Is Cool', Text::capitalize('laravel is cool', is_each_word: true));
    }

    #[TestDox('Text::capitalize: если передать предложение на русском, "ларавел это круто", то возвращается кап-е "Ларавел это круто"')]
    public function test_capitalize_russian_sentence():void {
        $this->assertEquals('Ларавел это круто', Text::capitalize('ларавел это круто'));
    }

    #[TestDox('Text::capitalize: если передать предложение на русском, "ларавел это круто" c is_each_word, то возвращается кап-е "Ларавел Это Круто"')]
    public function test_capitalize_russian_sentence_with_is_each_word():void {
        $this->assertEquals('Ларавел Это Круто', Text::capitalize('ларавел это круто', is_each_word: true));
    }

    #[TestDox('Text::capitalize: если в предложении не первые симсолы в uppercase, то все они будут преведены в lowercase, "laravel IS COOL" -> "Laravel Is Cool"')]
    public function test_capitalize_no_first_uppercase_letters_convert_to_lowercase():void {
        $this->assertEquals('Laravel Is Cool', Text::capitalize('Laravel IS COOL', is_each_word: true));
    }

    #[TestDox('Text::capitalize: если передать предложение на английском, "laravel is COOL" с п-м is_each_word и is_safe, то возвращается кап-е "Laravel Is COOL"')]
    public function test_capitalize_english_sense_with_is_each_word_and_is_safe():void {
        $this->assertEquals('Laravel Is COOL', Text::capitalize('laravel is COOL', is_each_word: true, is_safe: true));
    }

    #[TestDox('Text::capitalize: если включен is_safe то is_reset не учитываеться, "laravel is COOL" -> "Laravel Is COOL"')]
    public function test_capitalize_if_pass_is_safe_is_reset_not_work():void {
        $this->assertEquals('Laravel Is COOL', Text::capitalize('laravel is COOL', is_reset: true, is_each_word: true, is_safe: true));
    }

    #[TestDox('Text::capitalize: если передать число то вернеться число')]
    public function test_pass_number():void {
        $this->assertEquals('100', Text::capitalize(100));
    }

    #[TestDox('Text::capitalize: если передать 0 то вернеться 0')]
    public function test_pass_zero():void {
        $this->assertEquals('0', Text::capitalize(0));
    }

    #[TestDox('Text::capitalize: если передать пустоту то выбросится исключение')]
    public function test_throw_when_text_is_empty():void {
        $this->expectException(\InvalidArgumentException::class);
        Text::capitalize("");
    }

    #[TestDox('Text::capitalize: если передать вместо текста множественный пробел то выбросится исключение')]
    public function test_throw_when_text_is_multi_whitespace():void {
        $this->expectException(\InvalidArgumentException::class);
        Text::capitalize("     ");
    }

    #[TestDox('Text::capitalize: если не передать ни одного параметра то выбросится ArgumentCountError')]
    public function test_throw_when_all_arguments_is_omitted():void {
        $this->expectException(\ArgumentCountError::class);
        Text::capitalize();
    }

    #[TestDox('Text::capitalize: если передать массив то выбросится ArgumentCountError')]
    public function test_throw_pass_array():void {
        $this->expectException(\TypeError::class);
        Text::capitalize([]);
    }






}
