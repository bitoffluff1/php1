<?php

//решение задачи 1
$a = 0;
while ($a <= 100) {
    if ($a % 3 === 0) {
        echo $a . ', ';
    }
    $a++;
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

echo '<hr>';

//решение задачи 3
$map = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Пушкин', 'Павловск'],
    'Краснодарский край' => ['Краснодар', 'Сочи', 'Новороссийск', 'Анапа']
];

foreach ($map as $key => $value) {
    $cities = [];
    foreach ($value as $city) {
        $cities[] = $city;
    }
    $str = implode(', ', $cities);

    echo $key . ': <br>';
    echo $str . '. <br>';
}

echo '<hr>';

//решение задачи 4
function transliteration($str)
{
    $letters = [
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
        " " => " "
    ];

    return $word = strtr($str, $letters);
}

echo transliteration('номер телефона');

echo '<hr>';

//решение задачи 5
function changeSpaces($str)
{
    return strtr($str, ' ', '_');
}

echo changeSpaces('номер телефона');

echo '<hr>';

//решение задачи 7
for($a = 0; $a < 10; print $a++ ){}

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
        $firstLetter = mb_substr($city, 0, 1);
        if($firstLetter == 'К'){
            $cities[] = $city;
        }
    }
    $str = implode(', ', $cities);

    if(!empty($str)){
        echo $key . ': <br>';
        echo $str . '. <br>';
    }
}

echo '<hr>';

//решение задачи 9
echo changeSpaces(transliteration('номер телефона'));
