<?php
include("config.php");

$a = (int)$_GET["a"];
$b = (int)$_GET["b"];
$operation = $_GET["operation"];
$content = mathOperation($a, $b, $operation);

$file = file_get_contents("index.html");
echo str_replace("{CONTENT}", $content, $file);