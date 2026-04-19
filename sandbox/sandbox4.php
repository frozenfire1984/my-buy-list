<?php

function digitize(int $n): array {
    if ($n === 0) return [0];
    return array_reverse(array_map('intval', str_split($n)));
}

try {
    print_r(digitize("68678678"));
} catch(Throwable $e) {
    echo "Error: " .$e->getMessage();
}
?>
