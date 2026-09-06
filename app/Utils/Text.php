<?php
namespace App\Utils;

class Text {
    public static function capitalize($text, $is_reset = false) {
        if (!$text) {
            throw new \InvalidArgumentException("omit test argument");
        }

        if ($is_reset) {
            $text = mb_strtolower($text, 'UTF-8');
        }

        return mb_strtoupper(mb_substr($text, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($text, 1, null, 'UTF-8');
    }
}
