<?php
/*
ЗАДАНИЕ 1
- Инициализируйте переменную для подсчета количества посещений
- Если соответствующие данные передавались через куки
  сохраняйте их в эту переменную 
- Нарастите счетчик посещений
- Инициализируйте переменную для хранения значения последнего посещения страницы
- Если соответствующие данные передавались из куки, отфильтруйте их и сохраните в эту переменную.
  Для фильтрации используйте функции trim(), htmlspecialchars()
- С помощью функции setcookie() установите соответствующие куки.  Задайте время хранения куки 1 сутки. 
  Для задания времени последнего посещения страницы используйте функцию date()
*/


$visitCount = 1;


if (isset($_COOKIE['visit_count'])) {
    $visitCount = (int)$_COOKIE['visit_count'] + 1;
}


$lastVisit = '';


if (isset($_COOKIE['last_visit'])) {
    $lastVisit = htmlspecialchars(trim($_COOKIE['last_visit']));
}


setcookie('visit_count', $visitCount, time() + 86400);


setcookie('last_visit', date('d.m.Y H:i:s'), time() + 86400);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Последний визит</title>
</head>
<body>

<h1>Последний визит</h1>

<?php
/*
ЗАДАНИЕ 2
- Выводите информацию о количестве посещений и дате последнего посещения
*/
?>

<p>Вы здесь уже <?php echo $visitCount; ?> раз</p>

<?php if (!empty($lastVisit)): ?>
    <p>Дата последнего посещения: <?php echo $lastVisit; ?></p>
<?php else: ?>
    <p>Это ваш первый визит!</p>
<?php endif; ?>

</body>
</html>