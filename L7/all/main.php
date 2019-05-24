<?php
session_start();
include("config.php");

$page = !empty($_GET["pages"]) ? $_GET["pages"] : "index";
$func = !empty($_GET["func"]) ? $_GET["func"] : "index";

$dir = __DIR__ . "/";

if (!file_exists($dir . "pages/" . $page . "Page.php")) {
    $page = "products";
}

include($dir . "pages/" . $page . "Page.php");

if (!function_exists($func)) {
    $func = "index";
}

$html = $func();

$file = file_get_contents($dir . "index.html");
$file = str_replace("{CONTENT}", $html, $file);
echo $file;