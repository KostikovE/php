<?php
	$login = ' User '; 
	$password = 'megaP@ssw0rd';
	$name = 'иван';
	$email = 'ivan@petrov.ru';
	$code = '<?=$login?>';
	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Использование функций обработки строк</title>
</head>
<body>

<?php
    $newlog = trim($login);
    $monkey = strtolower($newlog);
    echo $monkey;
    echo "<br>";
    
    
    
    function isValidPassword($password) {
    
        if (strlen($password) < 8) {
            return false;
        }
    
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            return false;
        }
        
        return true;
    }
    echo "{$password} : " . (isValidPassword($password) ? "валидный пароль!" : "невалидный пароль(") . "\n";
    echo "<br>";
    
    echo mb_ucfirst($name); 
    echo "<br>";
    
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "\"$email\" - является корректным email-адресом.";
    }  else {
    echo "\"$email\" - является корректным email-адресом.";
}
    echo "<br>";



    echo "<pre>" . htmlspecialchars($code) . "</pre>"
?>

</body>
</html>