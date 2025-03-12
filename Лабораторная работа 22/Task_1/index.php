<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Task 1</title>
    </head>
    <body>
        <?php
        //1
        include('./php_scripts/hello_all.php');
        echo '</br></br>';
        include('./php_scripts/number_e.php');
        echo '</br>';

        //2
        $a = 10;
        $b = 20;
        echo "a = $a; b = $b" . '</br>';
        $c = $a + $b;
        echo "c = $c" . '</br></br>';

        //3
        $n = 20;
        for ($i = 1; $i <= $n + 5; $i++) {
            echo "$i) Nikita Supruniuk</br>";
        }
        echo '</br>';

        //4
        $array;
        for ($i = 0; $i < 5; $i++) {
            $array[$i] = random_int(-100, 100);
        }

        echo 'Source array: ';
        foreach ($array as $value) {
            echo $value . ' ';
        }
        echo '</br>';
        echo 'Min element: ' . min($array);
        echo '</br></br>';

        //5
        $s1 = 'I love Belarus!';
        $s2 = 'I study at the Polytechnic College';
        echo 'Source strokes:</br>';
        echo $s1 . '</br>';
        echo $s2 . '</br>';
        echo 'Length first string: ' . strlen($s1) . '</br>';
        $n = 20;
        while ($n >= strlen($s1)) {
            $n -= strlen($s1);
        }
        $ascii = dechex(ord($s1[$n]));
        echo "ASCII-code $n symbol in stroke1: $ascii";
        echo '</br></br>';

        //6
        function calcFunc($x, $y) {
            return pow($y, $x) + sqrt(abs($x) + pow(M_E, $y)) - log(abs(pow($x, 2) + 3 * $x - 5));
        }

        echo 'f = y^x + sqrt(|x| + e^y) - lg|x^2 + 3x - 5|</br>';
        ?>
        <form method="GET" action="">
            <input type="number" name="valueX" placeholder="Input X">
            <input type="number" name="valueY" placeholder="Input Y">
            <button type="submit">Calculate</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['valueX']) && isset($_GET['valueY'])) {
            $x = $_GET['valueX'];
            $y = $_GET['valueY'];
            echo 'f = ' . calcFunc((int)$x, (int)$y);
        }
        ?>
    </body>
</html>
