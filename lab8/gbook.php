<?php
/* ЗАДАНИЕ 1 */

require_once 'config.php';


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}


$mysqli->set_charset(DB_CHARSET);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['msg'])) {
  
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $msg = trim($_POST['msg']);
    
 
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $msg = htmlspecialchars($msg);
    
    $name = $mysqli->real_escape_string($name);
    $email = $mysqli->real_escape_string($email);
    $msg = $mysqli->real_escape_string($msg);
    
   
    $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
    
  
    if ($mysqli->query($sql)) {
     
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Ошибка при добавлении сообщения: " . $mysqli->error;
    }
}

/* ЗАДАНИЕ 3 */

if (isset($_GET['delete_id'])) {
    // Фильтрация полученных данных
    $delete_id = (int)$_GET['delete_id']; 
    

    $sql_delete = "DELETE FROM msgs WHERE id = $delete_id";

    if ($mysqli->query($sql_delete)) {

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Ошибка при удалении сообщения: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книга</title>
    <style>
        .message {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            background-color: white;
        }
        .message-header {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .message-email {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .delete-link {
            color: #ff0000;
            text-decoration: none;
            font-size: 0.9em;
        }
        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Гостевая книга</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    Ваше имя:<br>
    <input type="text" name="name" required><br>
    Ваш E-mail:<br>
    <input type="email" name="email"><br>
    Сообщение:<br>
    <textarea name="msg" cols="50" rows="5" required></textarea><br>
    <br>
    <input type="submit" value="Добавить!">
</form>

<?php
/* ЗАДАНИЕ 2 */

$sql_select = "SELECT * FROM msgs ORDER BY id DESC";


$result = $mysqli->query($sql_select);


if ($result) {
  
    $row_count = $result->num_rows;
    echo "<h2>Всего сообщений: $row_count</h2>";
    

    while ($row = $result->fetch_assoc()) {
        echo "<div class='message'>";
        echo "<div class='message-header'>" . htmlspecialchars($row['name']) . "</div>";
        
        if (!empty($row['email'])) {
            echo "<div class='message-email'>Email: " . htmlspecialchars($row['email']) . "</div>";
        }
        
        echo "<div class='message-text'>" . nl2br(htmlspecialchars($row['msg'])) . "</div>";
        
        
        echo "<br><a class='delete-link' href='" . htmlspecialchars($_SERVER['PHP_SELF']) . 
             "?delete_id=" . $row['id'] . "' onclick=\"return confirm('Вы уверены, что хотите удалить это сообщение?');\">Удалить</a>";
        
        echo "</div>";
    }
    
   
    $result->free();
} else {
    echo "Ошибка при получении сообщений: " . $mysqli->error;
}


$mysqli->close();
?>

</body>
</html>