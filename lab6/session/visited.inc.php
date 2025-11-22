<?php



echo '<div class="visited-list">';
echo '<h3>Список посещённых страниц:</h3>';

if (isset($_SESSION['visited_pages']) && !empty($_SESSION['visited_pages'])) {
    echo '<ol>';
    
    foreach ($_SESSION['visited_pages'] as $index => $page) {
        $page_name = basename($page, '.php');
        $page_name = str_replace('page', 'Страница ', $page_name);
        
        echo '<li>' . $page_name . '</li>';
    }
    
    echo '</ol>';
} else {
    echo '<p>Список пуст</p>';
}

echo '</div>';
?>