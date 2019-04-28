<?php

$a = rand(-100, 100);
$b = rand(-100, 100);
echo 'a = ' . $a . '<br>';
echo 'b = ' . $b . '<br>';

if ($a >= 0 && $b >= 0) {
    echo $a - $b . '<br>';
} elseif ($a < 0 && $b < 0) {
    echo $a * $b . '<br>';
} elseif ($a < 0 && $b >= 0 || $a > 0 && $b <= 0) {
    echo $a + $b . '<br>';
}

echo '<hr>';

$a = rand(0, 15);
echo 'a = ' . $a . '<br>';

switch ($a) {
    case 0:
        echo 0;
        break;
    case 1:
        echo '0, 1';
        break;
    case 2:
        echo '0, 1, 2';
        break;
    case 3:
        echo '0, 1, 2, 3';
        break;
    case 4:
        echo '0, 1, 2, 3, 4';
        break;
    case 5:
        echo '0, 1, 2, 3, 4, 5';
        break;
    case 6:
        echo '0, 1, 2, 3, 4, 5, 6';
        break;
    case 7:
        echo '0, 1, 2, 3, 4, 5, 6, 7';
        break;
    case 8:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8';
        break;
    case 9:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9';
        break;
    case 10:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10';
        break;
    case 11:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11';
        break;
    case 12:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12';
        break;
    case 13:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13';
        break;
    case 14:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14';
        break;
    case 15:
        echo '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15';
        break;
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

function mathOperation($a, $b, $operation){
    switch ($operation){
        case 'addition':
            echo addition($a, $b) . '<br>';
            break;
        case 'subtraction':
            echo subtraction($a, $b) . '<br>';
            break;
        case 'multiplication':
            echo multiplication($a, $b) . '<br>';
            break;
        case 'division':
            echo division($a, $b) . '<br>';
            break;
    }
}

mathOperation($a, $b, 'division');
echo '<hr>';

function power($val, $pow){
    if($pow != 1){
        $pow--;
        return $val * power($val, $pow);
    }else{
        return $val;
    }
}

echo power($b, $a);
echo '<hr>';


function getMinutes($minutes){
    if($minutes == 1){
        return "минута";
    }else if($minutes == 2 || $minutes == 3 || $minutes == 4){
        return "минуты";
    }else if($minutes > 4 && $minutes < 21){
        return "минут";
    }else{
        $min = mb_substr($minutes, 1, 1);
        return getMinutes($min);
    }
}


function getHours($hours){
    if($hours == 1){
        return "час";
    }else if($hours == 2 || $hours == 3 || $hours == 4){
        return  "часa";
    }else if($hours > 4 && $hours < 21){
        return "часов";
    }else{
        $hour = mb_substr($hours, 1, 1);
        return getHours($hour);
    }
}

$hours = date("G");
$minutes = date("i");
echo "$hours " . getHours($hours) . " $minutes " . getMinutes($minutes);




