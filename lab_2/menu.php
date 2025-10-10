<?php
declare(strict_types=1);

/**
 * Создание массива для навигационного меню
 * 
 * Массив содержит ассоциативные массивы с пунктами меню
 * Каждый элемент имеет ключи 'link' (текст ссылки) и 'href' (URL адрес)
 * 
 * @var array $leftMenu Массив структуры меню
 */
$leftMenu = [
    [
        'link' => 'Домой',
        'href' => 'index.php'
    ],
    [
        'link' => 'О нас',
        'href' => 'about.php'
    ],
    [
        'link' => 'Контакты',
        'href' => 'contact.php'
    ],
    [
        'link' => 'Таблица умножения',
        'href' => 'table.php'
    ],
    [
        'link' => 'Калькулятор',
        'href' => 'calc.php'
    ]
];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Меню</title>
	<style>
		.menu {
			list-style-type: none;
			margin: 0;
			padding: 0;
			width:200px;
		}
		
		.menu li {
			margin-bottom: 5px;
		}
		
		.menu a {
			text-decoration: none;
			color: #333;
			padding: 5px 10px;
			display: block;
			border: 1px solid #ddd;
			border-radius: 3px;
		}
		
		.menu a:hover {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
	<h1>Меню</h1>
	<nav>
	

	
	<ul class="menu">
		<?php
		/**
		 * Отрисовка навигационного меню с помощью цикла foreach
		 * 
		 * Цикл перебирает каждый элемент массива $leftMenu
		 * Для каждого элемента создается пункт списка с ссылкой
		 * 
		 * @param array $item Элемент меню с ключами 'link' и 'href'
		 */
		foreach ($leftMenu as $item): 
		?>
			<li>
				<a href='<?= $item['href'] ?>'>
					<?= $item['link'] ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	
	</nav>
</body>
</html>