<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Подключаем PHPMailer (если установлен через Composer)

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email'])) {
    $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $message = "Ошибка: Некорректный email!";
    } else {
        $mail = new PHPMailer(true);

        try {
            // Настройки SMTP-сервера
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP-сервер
            $mail->SMTPAuth = true;
            $mail->Username = 'smaldina674400@gmail.com'; // Ваша почта
            $mail->Password = 'wbha yncw okll bsls'; // Пароль приложения
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            // Отправитель и получатель
            $mail->setFrom('your_email@gmail.com', 'Подписка');
            $mail->addAddress($userEmail);

            // Контент письма
            $mail->isHTML(true);
            $mail->Subject = 'Подтверждение подписки';
            $mail->Body = '<h1>Спасибо за подписку!</h1><p>Вы успешно подписались на нашу рассылку.</p>';
            $mail->AltBody = 'Спасибо за подписку! Вы успешно подписались на нашу рассылку.';

            // Отправка письма
            $mail->send();
            $message = "Письмо успешно отправлено!";
        } catch (Exception $e) {
            $message = "Ошибка при отправке письма: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Подписка на рассылку</title>
    </head>
    <body>
        <form method="POST">
            <label for="email">Введите ваш email:</label>
            <input type="email" name="email" required>
            <button type="submit">Подписаться</button>
        </form>

<?php if (!empty($message)): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
    </body>
</html>
