<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$pdo = new PDO('mysql:host=localhost;dbname=myshop', 'root', 'fa76Nm_1');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_GET['search'] ?? '';
$sortOptions = ['name', 'price']; // Разрешенные поля для сортировки
$sort = in_array($_GET['sort'] ?? '', $sortOptions) ? $_GET['sort'] : 'name';

// Загрузка данных о картинках из JSON
$jsonFile = 'json/images.json';
$jsonData = file_get_contents($jsonFile);
$imagesJson = json_decode($jsonData, true);

// Получение данных о товарах из базы
$query = "SELECT * FROM products WHERE name LIKE :search ORDER BY $sort ASC";
$stmt = $pdo->prepare($query);
$stmt->execute(['search' => "%$search%"]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Добавление изображений к товарам
$productImages = [];
foreach ($imagesJson['images'] as $image) {
    $productImages[$image['product_id']] = $image['image_url'];
}

// Присваивание изображений
foreach ($products as $key => $product) {
    $products[$key]['image_url'] = $productImages[$product['id']] ?? 'images/default.jpg';
}
?>


<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Каталог товаров</title>
        <link rel="stylesheet" href="css/catalog.css">
    </head>
    <body>
        <div class="container">
            <h2>Каталог товаров</h2>
            <form method="GET">
                <input type="text" name="search" placeholder="Поиск" value="<?= htmlspecialchars($search) ?>">
                <select name="sort">
                    <option value="name" <?= $sort == 'name' ? 'selected' : '' ?>>По названию</option>
                    <option value="price" <?= $sort == 'price' ? 'selected' : '' ?>>По цене</option>
                </select>
                <button type="submit">Применить</button>
            </form>
            <div class="product-list">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p>Цена: <?= htmlspecialchars($product['price']) ?> руб.</p>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit">Добавить в корзину</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            <p>
                <a href="cart.php" class="cart-button">🛒 Корзина (<?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?>)</a>
                | <a href="logout.php">Выйти</a>
            </p>

        </div>
    </body>
</html>
