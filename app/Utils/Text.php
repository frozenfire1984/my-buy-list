<?php
namespace App\Utils;

class Text {
    private static function _cap_single(string $str):string {
        return mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($str, 1, null, 'UTF-8');
    }

    private static function _cap_multi(string $str):string {
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }

    private static function _cap_multi_safe(string $str):string {
        $str_arr = explode(" ", $str);
        foreach ($str_arr as &$chunk) {
            $chunk = self::_cap_single($chunk);
        }
        unset($chunk);
        return implode(" ", $str_arr);
    }

    public static function capitalize(string $text, bool $is_reset = false, bool $is_each_word = false, bool $is_safe = false):string {

        if (trim($text) === "") {
            throw new \InvalidArgumentException("text argument is whitespace");
        }

        if ($is_reset && !$is_safe) {
            $text = mb_strtolower($text, 'UTF-8');
        }

        /*if ($is_reset) {
            $text = mb_strtolower($text, 'UTF-8');
        }*/

        if ($is_each_word) {
            if ($is_safe) {
                return self::_cap_multi_safe($text);
            }

            return self::_cap_multi($text);
        } else {
            return self::_cap_single($text);
        }
    }
}
