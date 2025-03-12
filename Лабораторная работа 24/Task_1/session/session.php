<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}

echo "Вы посетили эту страницу {$_SESSION['counter']} раз.";
?>
<a href="session.php">Обновить</a>
<a href="session_destroy.php">Сбросить сессию</a>
