<?php
declare(strict_types=1);


// header('Content-Type: text/html; charset=UTF-8');


$var = 'ПРИВЕТ';


$i = 0;

// Цикл while для вывода символов в столбик
while ($i < mb_strlen($var)) {
    echo mb_substr($var, $i, 1) . "<br>";
    $i++;
}
?>
