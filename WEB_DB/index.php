<?php

define('DB_HOST', 'db4free.net');
define('DB_PORT', '*****');
define('DB_NAME', 'regions1');
define('DB_USER', 'kostikov22');
define('DB_PASSWORD', '*********');

// Настройки для Springhost
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$conn = null;


/**
 * Подключение к базе данных
 */
function connectToDatabase() {
    global $conn;
    
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        
        if ($conn->connect_error) {
            return false;
        }
        
        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Проверка и восстановление соединения
 */
function ensureConnection() {
    global $conn;
    
    // Если соединение уже активно, проверяем его
    if ($conn && $conn->thread_id) {
        try {
            // Пробуем выполнить простой запрос
            if ($conn->query("SELECT 1")) {
                return true;
            }
        } catch (Exception $e) {
            // Соединение разорвано, переподключаемся
            $conn = null;
        }
    }
    
    // Подключаемся заново
    return connectToDatabase() !== false;
}

/**
 * Вывод сообщения об ошибке
 */
function displayError($message, $details = '') {
    echo '<div style="background-color: #ffe6e6; border: 1px solid #ff9999; 
          padding: 12px; margin: 10px 0; border-radius: 5px; color: #cc0000; font-size: 14px;">
          <strong>Ошибка:</strong> ' . htmlspecialchars($message);
    if ($details) {
        echo '<br><small>' . htmlspecialchars($details) . '</small>';
    }
    echo '</div>';
}

/**
 * Вывод сообщения об успехе
 */
function displaySuccess($message) {
    echo '<div style="background-color: #e6ffe6; border: 1px solid #99ff99; 
          padding: 12px; margin: 10px 0; border-radius: 5px; color: #006600; font-size: 14px;">
          <strong>Успех:</strong> ' . htmlspecialchars($message) . '
          </div>';
}

/**
 * Вывод информационного сообщения
 */
function displayInfo($message) {
    echo '<div style="background-color: #e7f3fe; border: 1px solid #2196F3; 
          padding: 12px; margin: 10px 0; border-radius: 5px; color: #0c5460; font-size: 14px;">
          <strong> Информация:</strong> ' . htmlspecialchars($message) . '
          </div>';
}

/**
 * Форматирование значения для вывода в таблице
 */
function formatValue($value, $maxLength = 20) {
    if ($value === null) {
        return str_pad('NULL', $maxLength, ' ', STR_PAD_RIGHT);
    }
    
    $strValue = (string)$value;
    
    // Обрезаем слишком длинные значения
    if (strlen($strValue) > $maxLength) {
        $strValue = substr($strValue, 0, $maxLength - 3) . '...';
    }
    
    return str_pad($strValue, $maxLength, ' ', STR_PAD_RIGHT);
}


/**
 * Выполнение SQL запроса 
 */
function executeSQL($sql) {
    global $conn;
    
    // Убеждаемся, что соединение активно
    if (!ensureConnection()) {
        displayError("Не удалось подключиться к базе данных. Проверьте подключение.");
        return false;
    }
    
    $sql = trim($sql);
    
    if (empty($sql)) {
        displayError("SQL запрос пустой");
        return false;
    }
    
    // Выполняем запрос
    $result = $conn->query($sql);
    
    if ($result === FALSE) {
        displayError("Ошибка выполнения запроса", $conn->error);
        return false;
    }
    
    // Если это INSERT, UPDATE, DELETE
    if ($result === TRUE) {
        $affected_rows = $conn->affected_rows;
        if ($affected_rows > 0) {
            displaySuccess("Запрос выполнен. Затронуто строк: " . $affected_rows);
        } else {
            displayInfo("Запрос выполнен, но не затронул строки");
        }
        return true;
    }
    
    // Если это SELECT (есть результат)
    $num_rows = $result->num_rows;
    
    if ($num_rows == 0) {
        displayInfo("Запрос выполнен, но возвращено 0 строк");
        return [];
    }
    
    echo '<div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; overflow-x: auto;">';
    echo '<table style="border-collapse: collapse; width: auto; font-family: \'Courier New\', monospace; font-size: 13px; table-layout: fixed;">';
    
    // Получаем поля
    $fields = $result->fetch_fields();
    
    // Вычисляем ширину для каждого столбца
    $column_widths = [];
    foreach ($fields as $field) {
        // Начинаем с ширины заголовка
        $max_width = strlen($field->name) * 8; // Примерная ширина в пикселях
        
        // Сохраняем текущую позицию в результате
        $current_pos = $result->current_field;
        
        // Перебираем все строки для этого столбца
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            $value = $row[$field->name];
            $str_length = strlen($value === null ? 'NULL' : (string)$value);
            $pixel_width = $str_length * 8; // Примерная ширина
            if ($pixel_width > $max_width) {
                $max_width = min($pixel_width, 300); // Максимум 300px
            }
        }
        
        // Возвращаем позицию
        $result->data_seek(0);
        $column_widths[$field->name] = $max_width . 'px';
    }
    
    // Заголовки
    echo '<thead><tr style="background: #e9ecef;">';
    foreach ($fields as $field) {
        echo '<th style="padding: 8px 12px; border: 1px solid #dee2e6; text-align: left; 
              white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: ' . $column_widths[$field->name] . ';">';
        echo htmlspecialchars($field->name);
        echo '</th>';
    }
    echo '</tr></thead>';
    
    // Данные
    echo '<tbody>';
    $row_num = 0;
    while ($row = $result->fetch_assoc()) {
        $bg_color = $row_num % 2 == 0 ? '#ffffff' : '#f8f9fa';
        echo '<tr style="background: ' . $bg_color . ';">';
        
        foreach ($fields as $field) {
            $value = $row[$field->name];
            echo '<td style="padding: 8px 12px; border: 1px solid #dee2e6; 
                  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: ' . $column_widths[$field->name] . ';">';
            echo htmlspecialchars($value === null ? 'NULL' : $value);
            echo '</td>';
        }
        
        echo '</tr>';
        $row_num++;
    }
    echo '</tbody>';
    
    echo '</table>';
    echo '</div>';
    
    displayInfo("Найдено строк: " . $num_rows);
    
    $result->free();
    return true;
}

/**
 * Проверка подключения к БД
 */
function testConnection() {
    global $conn;
    
    // Подключаемся к базе
    if (connectToDatabase()) {
        displaySuccess("Подключение успешно!");
        
        // Получаем информацию о сервере
        $server_info = [
            'Версия MySQL' => $conn->server_version,
            'Имя хоста' => $conn->host_info,
            'Кодировка' => $conn->character_set_name(),
            'Текущая БД' => $conn->query("SELECT DATABASE()")->fetch_row()[0]
        ];
        
        echo '<div style="background: #f0f8ff; padding: 12px; border-radius: 5px; margin: 10px 0; font-size: 13px;">';
        echo '<strong>Информация о сервере:</strong><br>';
        foreach ($server_info as $key => $value) {
            echo $key . ': ' . $value . '<br>';
        }
        
        // Список таблиц
        $result = $conn->query("SHOW TABLES");
        if ($result->num_rows > 0) {
            echo '<br><strong>Таблицы в базе:</strong><br>';
            while ($row = $result->fetch_row()) {
                echo '• ' . $row[0] . '<br>';
            }
        } else {
            echo '<br><em>В базе нет таблиц</em>';
        }
        echo '</div>';
        
        // Не закрываем соединение, чтобы можно было выполнять запросы
        return true;
    } else {
        displayError("Не удалось подключиться к базе данных");
        return false;
    }
}


// ОБРАБОТКА ФОРМЫ
$result_displayed = false;
$sql_input = '';
$sql_file_content = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql_input = isset($_POST['sql_text']) ? trim($_POST['sql_text']) : '';
    
    if (isset($_POST['test_connection'])) {
        echo '<div style="margin-bottom: 20px;">';
        testConnection();
        echo '</div>';
        $result_displayed = true;
        
    } elseif (!empty($sql_input)) {
        echo '<div style="margin-bottom: 20px;">';
        executeSQL($sql_input);
        echo '</div>';
        $result_displayed = true;
        
    } elseif (isset($_FILES['sql_file']) && $_FILES['sql_file']['error'] == UPLOAD_ERR_OK) {
        echo '<div style="margin-bottom: 20px;">';
        
        $file_path = $_FILES['sql_file']['tmp_name'];
        $file_name = $_FILES['sql_file']['name'];
        
        displayInfo("Загружен файл: " . htmlspecialchars($file_name));
        
        $sql_content = file_get_contents($file_path);
        $sql_input = trim($sql_content);
        
        executeSQL($sql_input);
        echo '</div>';
        $result_displayed = true;
    } else {
        displayError("Введите SQL запрос или выберите файл");
    }
}

// Если есть активное соединение, показываем статус
if ($conn && $conn->thread_id) {
    echo '<div id="connection-status" style="position: fixed; top: 20px; right: 20px; background: #d4edda; color: #155724; padding: 10px 15px; border-radius: 5px; font-size: 12px; z-index: 1000; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
        Соединение активно
    </div>';
}


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление базой данных</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: white;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
            position: relative;
        }
        
        .header {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 1em;
            opacity: 0.9;
        }
        
        .config-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            margin: 20px;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .config-info strong {
            color: #856404;
        }
        
        .content {
            padding: 25px;
        }
        
        .form-container {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #495057;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #dee2e6;
            border-radius: 6px;
            font-size: 14px;
            font-family: monospace;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .btn {
            padding: 12px 25px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            min-width: 150px;
        }
        
        .btn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .btn-info {
            background: #17a2b8;
        }
        
        .btn-info:hover {
            background: #138496;
        }
        
        .examples {
            background: #e7f3fe;
            border-left: 4px solid #2196F3;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .examples h3 {
            color: #0c5460;
            margin-bottom: 15px;
            font-size: 1.1em;
        }
        
        .code-example {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            overflow-x: auto;
            margin: 10px 0;
            line-height: 1.4;
        }
        
        .example-btn {
            background: none;
            border: 1px solid #2196F3;
            color: #2196F3;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            margin: 5px;
            transition: all 0.3s;
        }
        
        .example-btn:hover {
            background: #2196F3;
            color: white;
        }
        
        .file-upload {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            padding: 20px;
            text-align: center;
            border-radius: 6px;
            margin: 15px 0;
        }
        
        .file-upload input[type="file"] {
            margin: 10px 0;
        }
        
        .result-container {
            margin-top: 30px;
        }
        
        .result-table {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            overflow-x: auto;
        }
        
        .result-table pre {
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            line-height: 1.4;
            white-space: pre;
        }
        
        footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            font-size: 13px;
        }
        
        .status-indicator {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 12px;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s ease;
        }
        
        .status-connected {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-disconnected {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .container {
                border-radius: 8px;
                width: 95%;
            }
            
            .header {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 1.5em;
            }
            
            .content {
                padding: 15px;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .status-indicator {
                position: static;
                margin: 10px 0;
                width: 100%;
            }
            
            .result-table {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1> Управление базой данных</h1>
          
        </div>
        
        <?php if ($conn && $conn->thread_id): ?>
        <div class="status-indicator status-connected">
            Соединение с БД активно
        </div>
        <?php else: ?>
        <div class="status-indicator status-disconnected">
            Соединение с БД не установлено
        </div>
        <?php endif; ?>
 //информация для пользователя (к какой базе подключились, какой пользователь)       
        <div class="config-info">
            <strong>Конфигурация подключения:</strong><br>
            Хост: <?php echo DB_HOST; ?> | База: <?php echo DB_NAME; ?> | Пользователь: <?php echo DB_USER; ?>
        </div>
        
        <div class="content">
            <div class="form-container">
                <h2 style="color: #4CAF50; margin-bottom: 20px; font-size: 1.3em;">SQL Запросы к базе данных</h2>
                
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sql_text">Введите SQL запрос:</label>
                        <textarea id="sql_text" name="sql_text" class="form-control" 
                                  placeholder="Введите любой SQL запрос..."><?php echo htmlspecialchars($sql_input); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Или загрузите SQL файл:</label>
                        <div class="file-upload">
                            <input type="file" name="sql_file" class="form-control" accept=".sql,.txt">
                            <small style="color: #666;">Поддерживаются файлы .sql и .txt</small>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" name="execute" class="btn"> Выполнить запрос</button>
                        <button type="submit" name="test_connection" class="btn btn-info"> Проверить подключение</button>
                        <button type="reset" class="btn btn-secondary">️ Очистить форму</button>
                    </div>
                    
                    <div style="margin-top: 15px; font-size: 12px; color: #666;">
                        <strong>Статус:</strong> 
                        <?php if ($conn && $conn->thread_id): ?>
                            <span style="color: #28a745;">Соединение активно</span> - можно выполнять запросы
                        <?php else: ?>
                            <span style="color: #dc3545;">Нет соединения</span> - сначала проверьте подключение
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            
            
            
            <?php if ($result_displayed): ?>
            <div class="result-container">
                <h3 style="color: #4CAF50; margin-bottom: 15px; font-size: 1.2em;"></h3>
                <!-- Результаты уже выведены выше через PHP -->
            </div>
            <?php endif; ?>
        </div>
        
        <footer>
            <p>PHP База данных &copy; <?php echo date('Y'); ?> </p>
            
        </footer>
    </div>
    
    <script>
        // Функция для вставки примеров
        function insertExample(sql) {
            document.getElementById('sql_text').value = sql;
            document.getElementById('sql_text').focus();
        }
        
        // Подсветка синтаксиса при вводе
        document.getElementById('sql_text').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Обработка загрузки файла
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024).toFixed(2);
                
                // Очищаем текстовое поле при выборе файла
                document.getElementById('sql_text').value = '';
                
                // Показываем информацию о файле
                const fileInfo = document.createElement('div');
                fileInfo.style.cssText = 'background: #e6ffe6; padding: 8px; margin: 10px 0; border-radius: 4px; font-size: 12px;';
                fileInfo.innerHTML = `Выбран файл: <strong>${fileName}</strong> (${fileSize} KB)`;
                
                const parent = this.parentNode;
                if (parent.querySelector('.file-info')) {
                    parent.querySelector('.file-info').remove();
                }
                parent.appendChild(fileInfo);
                fileInfo.className = 'file-info';
            }
        });
        
        // Автофокус на поле ввода при загрузке страницы
        window.addEventListener('load', function() {
            const sqlText = document.getElementById('sql_text');
            if (sqlText.value === '') {
                sqlText.focus();
            }
            
            // Показываем уведомление о необходимости проверки подключения
            <?php if (!($conn && $conn->thread_id)): ?>
            setTimeout(function() {
                alert('Для выполнения запросов сначала проверьте подключение к базе данных.');
            }, 500);
            <?php endif; ?>
        });
        
        // Предупреждение о сбросе формы
        document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
            if (document.getElementById('sql_text').value.trim() !== '') {
                if (!confirm('Вы уверены, что хотите очистить форму?')) {
                    e.preventDefault();
                }
            }
        });
        
        // Предупреждение при попытке выполнить запрос без подключения
        document.querySelector('button[name="execute"]').addEventListener('click', function(e) {
            const sqlText = document.getElementById('sql_text').value.trim();
            const fileInput = document.querySelector('input[type="file"]');
            
            if (sqlText === '' && (!fileInput.files || fileInput.files.length === 0)) {
                alert('Введите SQL запрос или выберите файл для выполнения.');
                e.preventDefault();
                return;
            }
            
            <?php if (!($conn && $conn->thread_id)): ?>
            if (!confirm('Соединение с БД не установлено. Хотите сначала проверить подключение?')) {
                e.preventDefault();
            }
            <?php endif; ?>
        });
    </script>
</body>
</html>
