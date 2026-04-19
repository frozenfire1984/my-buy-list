<?php

function digitize(int $n): array {
    if ($n === 0) return [0];
    return array_reverse(array_map('intval', str_split($n)));
}

print_r(digitize(234234));

?>
