<?php



$result = null;
$num1 = '';
$num2 = '';
$operator = '+';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Фильтрация и получение значений
    $num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    $num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
    $operator = filter_input(INPUT_POST, 'operator', FILTER_SANITIZE_SPECIAL_CHARS);

    // Проверка корректности введённых данных
    if ($num1 === false || $num2 === false)
        $result = 'Ошибка: введите корректные числа!';
    else {
        // Выполнение операции в зависимости от оператора
        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0)
                    $result = 'делить на ноль нельзя!';
                else
                    $result = $num1 / $num2;
                break;
            default:
                $result = 'Ошибка: некорректный оператор!';
        }
    }
}
?>


<?php

if ($result !== null)
    echo "<h2>Результат: $result</h2>";
?>

<form method="post">

    <p><label for="num1">Число 1</label><br>
        <input type="text" name="num1" id="num1" value="<?= htmlspecialchars($num1) ?>" required>
    </p>

    <p><label for="operator">Оператор</label><br>
        <select name="operator" id="operator">
            <option value="+" <?= $operator == '+' ? 'selected' : '' ?>>+</option>
            <option value="-" <?= $operator == '-' ? 'selected' : '' ?>>-</option>
            <option value="*" <?= $operator == '*' ? 'selected' : '' ?>>*</option>
            <option value="/" <?= $operator == '/' ? 'selected' : '' ?>>/</option>
        </select>
    </p>

    <p><label for="num2">Число 2</label><br>
        <input type="text" name="num2" id="num2" value="<?= htmlspecialchars($num2) ?>" required>
    </p>

    <button type="submit">Считать!</button>

</form>