<?php

//решение задачи iwu
$a = 0;
while ($a <= 100) {
    if ($a % 3 === 0) {
        echo $a . ', ';
    }
    $a++;
}

//второй вариант

$a = 3;
while ($a <= 100) {
    if ($a % 3 === 0) {
        echo $a . ', ';
    }
    $a = $a + 3;
}

echo '<hr>';

//решение задачи 2
$a = 0;
do {
    if ($a === 0) {
        echo $a . '- это ноль. <br>';
    } elseif ($a % 2 === 0) {
        echo $a . '- четное число. <br>';
    } else {
        echo $a . '- нечетное число. <br>';
    }
    $a++;
} while ($a <= 10);

//второй вариант
$a = 0;
echo $a++ . '- это ноль. <br>';
do {
    echo $a++ . '- нечетное число. <br>';
    echo $a++ . '- четное число. <br>';
} while ($a <= 10);


echo '<hr>';

//решение задачи 3
$map = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Пушкин', 'Павловск'],
    'Краснодарский край' => ['Краснодар', 'Сочи', 'Новороссийск', 'Анапа']
];

foreach ($map as $key => $value) {
    echo $key . ': <br>';
    echo implode(', ', $value) . '. <br>';
}

echo '<hr>';

//решение задачи 4
function getTranslitArray()
{
    return [
        "а" => "a",
        "б" => "b",
        "в" => "v",
        "г" => "g",
        "д" => "d",
        "е" => "e",
        "ё" => "yo",
        "ж" => "zh",
        "з" => "z",
        "и" => "i",
        "й" => "y",
        "к" => "k",
        "л" => "l",
        "м" => "m",
        "н" => "n",
        "о" => "o",
        "п" => "p",
        "р" => "r",
        "с" => "s",
        "т" => "t",
        "у" => "u",
        "ф" => "f",
        "х" => "h",
        "ц" => "ts",
        "ч" => "ch",
        "ш" => "sh",
        "щ" => "s'h",
        "ъ" => "",
        "ы" => "i",
        "ь" => "'",
        "э" => "e",
        "ю" => "yu",
        "я" => "ya",
        " " => "_"
    ];
}

function transliteration($str)
{
    return strtr($str, getTranslitArray());
}

echo transliteration('номер телефона');


//второй вариант
$str = 'номер телефона';

for ($i = 0; $i < mb_strlen($str); $i++) { //strlen это длина строк
    echo getTranslitArray()[mb_substr($str, $i, 1)]; // аналогично записи $a["н"] получаем значение n
}


echo '<hr>';

//решение задачи 5
function changeSpaces($str)
{
    return strtr($str, ' ', '_');
}

echo changeSpaces('номер телефона');

//второй вариант

function changeSpaces2($str)
{
    return str_replace(' ', '_', $str);
}

echo changeSpaces2('номер телефона');

echo '<hr>';

//решение задачи 7
for ($a = 0; $a < 10; print $a++) {
}

echo '<hr>';

//решение задачи 8
$map = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Пушкин', 'Павловск'],
    'Краснодарский край' => ['Краснодар', 'Сочи', 'Новороссийск', 'Анапа']
];

foreach ($map as $key => $value) {
    $cities = [];
    foreach ($value as $city) {
        if (mb_substr($city, 0, 1) === 'К') {
            $cities[] = $city;
        }
    }
    $str = implode(', ', $cities);

    if (!empty($str)) {
        echo $key . ': <br>';
        echo $str . '. <br>';
    }
}


//второй вариант
foreach ($map as $key => $value) {
    echo $key . ': <br>';
    foreach ($value as $city) {
        if (mb_substr($city, 0, 1) === 'К') {
            echo $city . '. <br>';
        }
    }
}

echo '<hr>';

//решение задачи 9
echo changeSpaces(transliteration('номер телефона'));
