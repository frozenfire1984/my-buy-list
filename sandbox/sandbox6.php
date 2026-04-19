<?php

set_exception_handler(function(Throwable $e) {
    echo "Глобальный обработчик поймал: " . $e->getMessage() . PHP_EOL;
    echo "Файл: " . $e->getFile() . ", Строка: " . $e->getLine() . PHP_EOL;
});

set_error_handler(function($severity, $message, $file, $line) {
    if ($severity === E_WARNING) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    if ($severity === E_DEPRECATED) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }
});

try {
    $content = file_get_contents(__DIR__ . '/test-folder/file.txt');
    echo $content;
} catch (ErrorException $e) {
    echo "Warning as Exception: " .$e->getMessage() . PHP_EOL;
    throw $e;
}

//$money = money_format('%.2n', 1234.56);


//trigger_error("устарело!", E_USER_DEPRECATED)

$name = "world";
echo "hello ${name}"; // E_DEPRECATED


?>
