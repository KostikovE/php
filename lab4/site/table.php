<?php
// Инициализация переменных
$cols = 10;
$rows = 10;
$color = '#ffff00';

// Обработка POST-запроса
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cols = abs((int) $_POST['cols']);
    $rows = abs((int) $_POST['rows']);
    $color = trim(strip_tags($_POST['color']));
    
    // Проверка и установка значений по умолчанию
    $cols = ($cols > 0) ? $cols : 10;
    $rows = ($rows > 0) ? $rows : 10;
    $color = ($color) ? $color : '#ffff00';
    
    // Убедимся, что цвет в правильном формате
    if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color)) {
        $color = '#ffff00';
    }
}
?>

<!-- Область основного контента -->
<h3>Таблица умножения</h3>
<form action='<?=$_SERVER['REQUEST_URI']?>' method='POST'>
    <label>Количество колонок: </label>
    <br>
    <input name='cols' type='text' value='<?=isset($_POST['cols']) ? htmlspecialchars($_POST['cols']) : $cols?>'>
    <br>
    <label>Количество строк: </label>
    <br>
    <input name='rows' type='text' value='<?=isset($_POST['rows']) ? htmlspecialchars($_POST['rows']) : $rows?>'>
    <br>
    <label>Цвет: </label>
    <br>
    <input name='color' type='color' value='<?=isset($_POST['color']) ? htmlspecialchars($_POST['color']) : $color?>' list="listColors">
    <datalist id="listColors">
        <option value="#ff0000">Красный</option>
        <option value="#00ff00">Зеленый</option>
        <option value="#0000ff">Синий</option>
        <option value="#ffff00">Желтый</option>
        <option value="#ff00ff">Пурпурный</option>
        <option value="#00ffff">Бирюзовый</option>
    </datalist>
    <br>
    <br>
    <input type='submit' value='Создать'>
    <br>
</form>

<!-- Таблица -->
<?php 
// Функция для создания таблицы умножения
function drawTable($rows, $cols, $color) {
    echo "<table border='1'>";
    for($tr = 1; $tr <= $rows; $tr++) {
        echo "<tr>";
        for($td = 1; $td <= $cols; $td++) {
            if($tr == 1 || $td == 1) {
                echo "<td style='background-color: $color; padding: 5px;'>" . $tr * $td . "</td>";
            } else {
                echo "<td style='padding: 5px;'>" . $tr * $td . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Вызов функции создания таблицы
drawTable($rows, $cols, $color);
?>
<!-- Таблица -->
<!-- Область основного контента -->
