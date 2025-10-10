<?php
declare(strict_types=1);


/**
 * @var int $cols Количество столбцов в таблице умножения
 * @var int $rows Количество строк в таблице умножения
 */
$cols = 8;
$rows = 6;

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
		}

		th,
		td {
			padding: 10px;
			border: 1px solid black;
			text-align: center;
		}

		th {
			background-color: yellow;
		}

		.header-cell {
			background-color: #ffeb3b;
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
	
	<table>
		<?php
		/**
		 * Отрисовка таблицы умножения
		 * 
		 * Используются вложенные циклы for для создания строк и столбцов
		 * Первая строка и первый столбец выделены как заголовочные
		 */
		for ($i = 1; $i <= $rows; $i++): 
		?>
			<tr>
				<?php for ($j = 1; $j <= $cols; $j++): ?>
					<?php
					/**
					 * Определение класса ячейки
					 * 
					 * @var string $cellClass Класс для стилизации ячейки
					 */
					$cellClass = ($i === 1 || $j === 1) ? 'header-cell' : 'data-cell';
					
					/**
					 
					 * @var int $cellValue Произведение номера строки и номера столбца
					 */
					$cellValue = $i * $j;
					?>
					
					<td class="<?= $cellClass ?>">
						<?= $cellValue ?>
					</td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</table>
	
</body>
</html>