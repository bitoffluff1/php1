<?php
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
        return 'На ноль делить нельзя!';
    }

    return round($a / $b, 2);
}

function mathOperation($a, $b, $operation)
{
    if (!function_exists($operation)) { //есть ли функция в списке встроенных и пользовательских
        return 'Неверно указана функция';
    }
    return $operation($a, $b) . '<br>';
}