<?php
$visits = isset($_COOKIE['visits']) ? $_COOKIE['visits'] + 1 : 1;
setcookie('visits', $visits, time() + 3600 * 24 * 30); // Срок действия 30 дней

echo "Вы посетили эту страницу $visits раз.";
?>
<a href="cookie_reset.php">Сбросить cookie</a>
