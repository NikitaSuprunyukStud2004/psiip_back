<?php
session_start();

if (isset($_POST['password'])) {
    $password = "admin123"; // Пароль администратора
    if ($_POST['password'] === $password) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "<p style='color: red;'>Неверный пароль!</p>";
    }
}
?>

<form method="POST">
    <input type="password" name="password" placeholder="Введите пароль" required>
    <button type="submit">Войти</button>
</form>
