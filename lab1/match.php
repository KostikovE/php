<?php
    $a = 6;
    $day = (int) $a;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Конструкция switch</title>
</head>
<body>
	<h1>Конструкция switch</h1>
	<?php

    $output = match (true) {
        $day < 1 || $day >7 => "Неизвестный день",
        $day > 1 && $day <6 => "Это рабочий день",
        $day > 5 && $day <8 => "Это выходной день",
};

var_dump($output);

	?> 
</body>
</html>