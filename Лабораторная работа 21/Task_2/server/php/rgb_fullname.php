<?php

$color = filter_input(INPUT_GET, 'color');

if (isset($color)) {
    echo '<p style="color:' . $color . '">Nikita Supruniuk</p>';
} else {
    echo "No color selected.";
}
