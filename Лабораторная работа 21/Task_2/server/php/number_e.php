<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

const NUM_E = 2.71828;
echo nl2br("Number PI: " . NUM_E . "\n");

$num_e1 = NUM_E;
echo nl2br("num_e1 $num_e1 \n");

settype($num_e1, "string");
$res = gettype($num_e1) . ' ' . $num_e1 . '</br>';
echo $res;

settype($num_e1, "int");
$res = gettype($num_e1) . ' ' . $num_e1 . '</br>';
echo $res;

settype($num_e1, "bool");
$res = gettype($num_e1) . ' ' . $num_e1 . '</br>';
echo $res;