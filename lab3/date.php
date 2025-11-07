<?php


    $now = time(;
    echo $now;
    echo "<br>";
    
    $birthday = mktime(0,0,0,7,21,2005);
	echo $birthday;
	echo"<br>";
    
    
    $hour = getdate();
    $current_hour = $hour['hours'];
    echo "Текущий час: " . $current_hour;
	echo "<br>";
	
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Использование функций даты и времени</title>
</head>
<body>
	
	<?php
	
	$welcome = " ";
	if ($current_hour>0 && $current_hour <6){
	    $welocome = 'Доброе утро';
	   
	}elseif($current_hour<=12 && $current_hour>=6){
	    $welcome = 'Добрый день';
	   
	}elseif($current_hour<=18 && $current_hour>=12){
	    $welcome = 'Добрый вечер';
	    
	}else{
	    $weclome = 'Доброй ночи';
	    
	}
	echo $welcome;
	echo "<br>";
	
	
	
	setlocale(LC_ALL, 'ru_RU.UTF-8');
	echo "<br>";
	
	
	
	$formatter = new IntlDateFormatter(
    'ru_RU',
    IntlDateFormatter::FULL,
    IntlDateFormatter::MEDIUM,
    'Europe/Moscow',
    IntlDateFormatter::GREGORIAN,
    "Сегодня d MMMM y 'года', eeee HH:mm:ss"
);


    echo $formatter->format(time());
	echo "<br>";
	

    


    $today = new DateTime();
    $nextBirthday = new DateTime($birthday);
    $nextBirthday->setDate($today->format('Y'), $nextBirthday->format('m'), $nextBirthday->format('d'));


    if ($today > $nextBirthday) {
        $nextBirthday->modify('+1 year');
    }

    $interval = $today->diff($nextBirthday);
    
    $totalSeconds = ($nextBirthday->getTimestamp() - $today->getTimestamp());
    $days = $interval->days;
    $hours = $interval->h;
    $minutes = $interval->i;
    $seconds = $interval->s;
    

    echo "До моего дня рождения осталось: $days дней, $hours часов, $minutes минут, $seconds секунд";
?>
	
	

</body>
</html>
