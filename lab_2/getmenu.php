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

/**
 * Функция для отрисовки навигационного меню
 * 
 * @param array $menu Массив с структурой меню
 * @param bool $vertical Флаг ориентации меню (true - вертикальное, false - горизонтальное)
 * @return void
 */
function getMenu(array $menu, bool $vertical = true): void
{
    /**
     * Определение класса меню в зависимости от ориентации
     * @var string $menuClass
     */
    $menuClass = $vertical ? 'menu vertical' : 'menu horizontal';
    ?>
    <ul class="<?= $menuClass ?>">
        <?php
        /**
         * Отрисовка пунктов меню с помощью цикла foreach
         * 
         * @param array $item Элемент меню с ключами 'link' и 'href'
         */
        foreach ($menu as $item): 
        ?>
            <li>
                <a href='<?= $item['href'] ?>'>
                    <?= $item['link'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}

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
		}

		.vertical {
			width: 200px; /* Фиксированная ширина для вертикального меню */
		}
		
		.vertical li {
			margin-bottom: 5px;
			display: block;
		}
		
		.vertical a {
			text-decoration: none;
			color: #333;
			padding: 8px 12px;
			display: inline-block; /* Изменено с block на inline-block */
			border: 1px solid #ddd;
			border-radius: 3px;
			background-color: #f9f9f9;
			transition: background-color 0.3s;
			width: auto; /* Ширина по содержимому */
		}
		
		.vertical a:hover {
			background-color: #e9e9e9;
		}

		.horizontal li {
			display: inline-block; /* Изменено с inline на inline-block */
			margin-right: 10px;
		}
		
		.horizontal a {
			text-decoration: none;
			color: #333;
			padding: 8px 12px;
			border: 1px solid #ddd;
			border-radius: 3px;
			background-color: #f9f9f9;
			transition: background-color 0.3s;
			display: inline-block; /* Добавлено для лучшего контроля */
		}
		
		.horizontal a:hover {
			background-color: #e9e9e9;
		}
	</style>
</head>
<body>
	<h1>Меню</h1>
	<?php
	/*
	ЗАДАНИЕ 3
	- Отрисуйте вертикальное меню вызывая функцию getMenu() с одним параметром
	*/
	?>
	<h2>Вертикальное меню (один параметр)</h2>
	<?php getMenu($leftMenu); ?>
	
	<?php
	/*
	ЗАДАНИЕ 4
	- Отрисуйте горизонтальное меню вызывая функцию getMenu() со вторым параметром равным false
	*/
	?>
	<h2>Горизонтальное меню (второй параметр false)</h2>
	<?php getMenu($leftMenu, false); ?>
	
	<h2>Вертикальное меню (второй параметр true)</h2>
	<?php getMenu($leftMenu, true); ?>
</body>
</html>