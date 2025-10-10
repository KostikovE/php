<?php
declare(strict_types=1);

/**
 * Функция для отрисовки таблицы умножения
 * 
 * @param int $cols Количество столбцов в таблице
 * @param int $rows Количество строк в таблице
 * @param string $color Цвет фона заголовочных ячеек
 * @return int Количество вызовов функции
 */
function getTable (int $cols =5 ,int $rows = 5, string $color = 'yellow'):
int
{
    static $count = 0;
    $count++;
    
    ?>
    <table>
        <?php for ($i = 1; $i <= $rows; $i++): ?>
            <tr>
                <?php for ($j = 1; $j <= $cols; $j++): ?>
                    <?php
                    $cellClass = ($i === 1 || $j === 1) ? 'header-cell' : 'data-cell';
                    $cellValue = $i * $j;
                    ?>
                    <td class="<?= $cellClass ?>" 
                        <?php if ($i === 1 || $j === 1): ?>
                            style="background-color: <?= $color ?>; font-weight: bold; text-align: center;"
                        <?php endif; ?>>
                        <?= $cellValue ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <?php
    
    return $count;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Таблица умножения</title>
	<style>
		table {
			border: 2px solid black;
			border-collapse: collapse;
			margin-bottom: 20px;
		
		}

		th,
		td {
			padding: 10px;
			border: 1px solid black;
			text-align: center;
		}

		.header-cell {
			font-weight: bold;
			text-align: center;
		}
		
		.data-cell {
			background-color: white;
		}
	</style>
</head>
<body> 
	<h1>Таблица умножения</h1>
	
	
	<h2>Таблица 5x5 (без параметров)</h2>
	<?php $count1 = getTable(); ?>
	
	<h2>Таблица 3x3 (один параметр)</h2>
	<?php $count2 = getTable(3); ?>
	
	<h2>Таблица 4x6 (два параметра)</h2>
	<?php $count3 = getTable(4, 6); ?>
	
	<h2>Таблица 8x8 (три параметра)</h2>
	<?php $count4 = getTable(8, 8, 'lightblue'); ?>
	
	<h2>Таблица 2x7</h2>
	<?php $count5 = getTable(2, 7, 'red'); ?>
	
	<?php
	/**
	 * Вывод общего количества вызовов функции
	 * Используем последнее возвращенное значение
	 */
	?>
	<p><strong>Общее количество вызовов функции getTable(): <?= $count5 ?></strong></p>
	
</body>
</html>