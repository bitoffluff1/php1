<?php
$name = "Helen";
$number1 = 15;
$number2 = "15";
$title = "First page on php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
</head>
<body>
<?php
echo "<h1>Hello, $name!</h1>";

echo var_dump($number1) . "<br>";

$number1++;
$sum = $number1 + $number2;
echo "Sum = " . $sum . "<br>";
echo var_dump((int)'hello, world') . "<br>";

echo "a = " . $number1 . " " . "b = " . $number2 . "<br>";
$number1 += +$number2 - $number2 = $number1;
echo "a = " . $number1 . " " . "b = " . $number2 . "<br>";

echo date("d l Y");
?>
</body>
</html>