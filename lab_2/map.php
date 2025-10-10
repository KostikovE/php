<?php
declare(strict_types=1);

/**
 * 
 * @param array $array Исходный массив
 * @param callable $callback Функция обратного вызова, применятся к каждому элементу
 * @return array Новый массив с результатами применения коллбэка
 */
function map(array $array, callable $callback): array
{
    $result = [];
    
    foreach ($array as $index => $item) {
        $result[$index] = $callback($item);
    }
    
    return $result;
}

// Пример использования с массивом чисел и стрелочной функцией
$numbers = [1, 2, 3, 4, 5];

$squaredNumbers = map($numbers, fn($number) => $number ** 2);

echo "Исходный массив: ". implode(', ',  $numbers ). "\n";
echo "Квадраты чисел: " . implode(', ', $squaredNumbers) . "\n";

?>
