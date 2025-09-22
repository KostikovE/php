<?php
$a=1;
$day = (int) $a;
$min = 1;
$max = 7;
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
	switch ($day){
	    case 1:
	        echo "Это рабочий день";
	        break;
	    case 2:
	        echo "Это рабочий день";
	        break;
	    case 3:
	        echo "Это рабочий день";
	        break;
	    case 4:
	        echo "Это рабочий день";
	        break;
	    case 5:
	        echo "Это рабочий день";
	        break;
	    case 6:
	        echo "Это выходной день";
	        break;
	    case 7:
	        echo "Это выходной день";
	        break;
	    default:
			echo "Неизвестный день";
			break;
	}
		?> 

</body>

</html>
