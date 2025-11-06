<?php
function getTable($rows = 5, $cols = 5, $color = 'lightblue') {
    echo "<table border='1' width='200'>";
    for ($tr = 1; $tr <= $rows; $tr++) {
        echo "<tr>";
        for ($td = 1; $td <= $cols; $td++) {
            if ($tr == 1 || $td == 1) {
                echo "<th bgcolor='$color'>" . $tr * $td . "</th>";
            } else {
                echo "<td>" . $tr * $td . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

function getMenu($menu, $vertical = true) {
    if (!$vertical) {
        $style = "display: inline-block; margin-right: 10px;";
    } else {
        $style = "";
    }
    
    echo "<ul>";
    foreach ($menu as $item) {
        echo "<li style='$style'><a href='{$item['href']}'>{$item['link']}</a></li>";
    }
    echo "</ul>";
}
?>