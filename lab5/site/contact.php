<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
   
    $subject = trim($_POST['subject'] ?? '');
    $subject = strip_tags($subject);
    $subject = htmlspecialchars($subject);
    
    $body = trim($_POST['body'] ?? '');
    $body = strip_tags($body);
    $body = htmlspecialchars($body);
    
  
    if (!empty($subject) && !empty($body)) {
        
      
        $to = 'uitro322@gmail.com';
        
        // Дополнительные заголовки
        $headers = "From: admin@center.ogu\r\n";
        $headers .= "Reply-To: admin@center.ogu\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        
        
        if (mail($to, $subject, $body, $headers)) {
            echo '<p style="color: green;">Письмо успешно отправлено!</p>';
        } else {
            echo '<p style="color: red;">Ошибка при отправке письма.</p>';
        }
        
    } else {
        echo '<p style="color: red;">Пожалуйста, заполните все поля.</p>';
    }
}
?>

<!-- Область основного контента -->
<h3>Адрес</h3>
<address>123456 Москва, Малый Американский переулок 21</address>
<h3>Задайте вопрос</h3>
<form action='' method='post'>
  <label>Тема письма: </label>
  <br>
  <input name='subject' type='text' size="50" value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '' ?>">
  <br>
  <label>Содержание: </label>
  <br>
  <textarea name='body' cols="50" rows="10"><?= isset($_POST['body']) ? htmlspecialchars($_POST['body']) : '' ?></textarea>
  <br>
  <br>
  <input type='submit' value='Отправить'>
</form>
<!-- Область основного контента -->
   