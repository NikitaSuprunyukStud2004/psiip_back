<?php
// Функция для определения дня недели на русском языке
function getRussianWeekday($date) {
    $weekday = date('D', strtotime($date)); // Получаем сокращенное название дня недели
    
    // Ассоциативный массив для перевода дней недели
    $weekdays = [
        'Mon' => 'понедельник',
        'Tue' => 'вторник',
        'Wed' => 'среда',
        'Thu' => 'четверг',
        'Fri' => 'пятница',
        'Sat' => 'суббота',
        'Sun' => 'воскресенье'
    ];
    
    return $weekdays[$weekday] ?? 'Неизвестный день';
}

// Вывод текущей даты, времени и дня недели
echo date('j. m. Y') . "<br>"; // Дата в кратком формате
echo date('H:i:s') . "<br>";  // Время в формате ЧЧ:ММ:СС
echo getRussianWeekday(date('Y-m-d')) . "<br>"; // День недели на русском
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Определение дня недели</title>
</head>
<body>
    <p>Текущая дата: <?php echo date('d.m.Y'); ?></p>
    <form method="post">
        <button type="submit" name="show_day">Определить день недели</button>
    </form>
    
    <?php
    // Обработка нажатия кнопки
    if (isset($_POST['show_day'])) {
        echo "<p>Сегодня " . getRussianWeekday(date('Y-m-d')) . "</p>";
    }
    ?>
</body>
</html>
