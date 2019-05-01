<?php

$a = rand(-100, 100);
$b = rand(-100, 100);
echo 'a = ' . $a . '<br>';
echo 'b = ' . $b . '<br>';

if ($a >= 0 XOR $b >= 0) { //проверка на разные знаки
    echo $a - $b . '<br>';
} elseif ($a < 0) { //если знаки одинаковые, то проверям одно из чисел на отрецательные
    echo $a * $b . '<br>';
} else { // если знаки одинаковые и не отрецательные, то все положительные
    echo $a + $b . '<br>';
}

echo '<hr>';

$a = rand(0, 15);
echo 'a = ' . $a . '<br>';

switch ($a) {
    case 0:
        echo ($a++) . ', ';
    case 1:
        echo ($a++) . ', ';
    case 2:
        echo ($a++) . ', ';
    case 3:
        echo ($a++) . ', ';
    case 4:
        echo ($a++) . ', ';
    case 5:
        echo ($a++) . ', ';
    case 6:
        echo ($a++) . ', ';
    case 7:
        echo ($a++) . ', ';
    case 8:
        echo ($a++) . ', ';
    case 9:
        echo ($a++) . ', ';
    case 10:
        echo ($a++) . ', ';
    case 11:
        echo ($a++) . ', ';
    case 12:
        echo ($a++) . ', ';
    case 13:
        echo ($a++) . ', ';
    case 14:
        echo ($a++) . ', ';
    case 15:
        echo($a++);
}

echo '<hr>';

function addition($a, $b)
{
    return $a + $b;
}

function subtraction($a, $b)
{
    return $a - $b;
}

function multiplication($a, $b)
{
    return $a * $b;
}

function division($a, $b)
{
    if ($b == 0) {
        echo 'На ноль делить нельзя!';
        return;
    }

    return round($a / $b, 2);
}

echo 'a = ' . $a . '<br>';
echo 'b = ' . $b . '<br>';

echo addition($a, $b) . '<br>';
echo subtraction($a, $b) . '<br>';
echo multiplication($a, $b) . '<br>';
echo division($a, $b) . '<br>';

echo '<hr>';

function mathOperation($a, $b, $operation)
{
    if (!function_exists($operation)) { //есть ли функция в списке встроенных и пользовательских
        return 'Неверно указана функция';
    }
    return $operation($a, $b) . '<br>';
}

echo mathOperation($a, $b, 'division');
echo '<hr>';

function power($val, $pow)
{
    if ($pow != 1) {
        $pow--;
        return $val * power($val, $pow);
    } else {
        return $val;
    }
}

echo power($b, $a);
echo '<hr>';


function getMinutes($minutes)
{
    if ($minutes == 1) {
        return "минута";
    } else if ($minutes == 2 || $minutes == 3 || $minutes == 4) {
        return "минуты";
    } else if ($minutes > 4 && $minutes < 21) {
        return "минут";
    } else {
        $min = mb_substr($minutes, 1, 1);
        return getMinutes($min);
    }
}


function getHours($hours)
{
    if ($hours == 1) {
        return "час";
    } else if ($hours == 2 || $hours == 3 || $hours == 4) {
        return "часa";
    } else if ($hours > 4 && $hours < 21) {
        return "часов";
    } else {
        $hour = mb_substr($hours, 1, 1);
        return getHours($hour);
    }
}


function getTime($value, $a = 'час', $b = 'часа', $c = 'часов')
{
    if ($value > 20) {
        $value %= 10;
    }
    if ($value == 1) {
        return $a;
    } else if ($value < 5 && $value > 1) {
        return $b;
    } else {
        return $c;
    }
}

$time = time();
$hours = date("G", $time);
$minutes = date("i", $time);
echo "$hours " . getHours($hours) . " $minutes " . getMinutes($minutes) . "<br>";
echo "$hours " . getTime($hours) . " $minutes " . getTime($minutes, 'минута', 'минуты', 'минут');



