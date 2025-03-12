<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=myshop', 'root', 'fa76Nm_1');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Проверка, что корзина не пуста
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: catalog.php");
    exit();
}

// Проверка, что пользователь авторизован
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Перенаправление на страницу авторизации
    exit();
}

// Инициализация переменной для ошибок
$errors = [];
$totalPrice = 0; // Переменная для расчета общей суммы

// Получаем информацию о товарах из корзины для расчета общей стоимости
foreach ($_SESSION['cart'] as $productId => $quantity) {
    // Получаем цену товара из базы данных
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Умножаем цену товара на количество и добавляем к общей сумме
        $totalPrice += $product['price'] * $quantity;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Валидация данных формы
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if (empty($name)) {
        $errors[] = "Введите ваше имя.";
    }
    if (empty($phone)) {
        $errors[] = "Введите ваш телефон.";
    }
    if (empty($address)) {
        $errors[] = "Введите адрес доставки.";
    }

    // Если ошибок нет, сохраняем заказ
    if (empty($errors)) {
        try {
            // Подключение к базе данных
            $pdo = new PDO('mysql:host=localhost;dbname=myshop', 'root', 'fa76Nm_1');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Вставляем заказ в таблицу заказов
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, name, phone, address, total_price, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user'], $name, $phone, $address, $totalPrice, 'Ожидает обработки']);

            // Получаем ID нового заказа
            $orderId = $pdo->lastInsertId();

            // Добавляем товары в заказ
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$orderId, $productId, $quantity]);
            }

            // Очистить корзину после оформления заказа
            unset($_SESSION['cart']);

            // Перенаправить на страницу подтверждения заказа
            header("Location: order_confirmation.php?order_id=$orderId");
            exit();
        } catch (PDOException $e) {
            // Если ошибка подключения или запроса, выводим сообщение
            $errors[] = 'Ошибка базы данных: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <h2>Оформление заказа</h2>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>

        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($phone ?? '') ?>" required>

        <label for="address">Адрес доставки:</label>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($address ?? '') ?>" required>

        <button type="submit">Оформить заказ</button>
    </form>

    <p><strong>Сумма заказа: <?= number_format($totalPrice, 2, '.', ' ') ?> руб.</strong></p>

    <p><a href="catalog.php">Вернуться в каталог</a></p>
</body>
</html>
