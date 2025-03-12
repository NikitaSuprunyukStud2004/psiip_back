<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

echo "<h1>Добро пожаловать в панель администратора!</h1>";
echo "<a href='logout.php'>Выйти</a>";
?>
