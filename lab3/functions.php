<?php


echo "<h2>Функции загруженных модулей PHP</h2>\n";


$loaded_extensions = get_loaded_extensions();


$total_functions = 0;


foreach ($loaded_extensions as $extension) {
    echo "<h3>Модуль: $extension</h3>\n";
    
    
    $functions = get_extension_funcs($extension);
    
    if ($functions) {
        echo "<ul>\n";
        foreach ($functions as $function) {
            echo "<li>$function</li>\n";
        }
        echo "</ul>\n";
        echo "<p>Количество функций в модуле: " . count($functions) . "</p>\n";
        
        
        $total_functions += count($functions);
    } else {
        echo "<p>В этом модуле нет функций</p>\n";
    }
    echo "<hr>\n";
}

// Выводим общее количество функций
echo "<h2>Итог</h2>\n";
echo "<p><strong>Общее количество функций: $total_functions</strong></p>\n";
echo "<p>Количество загруженных модулей: " . count($loaded_extensions) . "</p>\n";

?>