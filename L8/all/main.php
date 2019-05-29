<?php
ini_set('max_execution_time', 900);
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

$message = "";
if (!empty($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
$html = $func();

$menuForAdmin = "";
if (!empty($_SESSION["adminKey"]) && $_SESSION["adminKey"] = ADMIN_KEY) {
    $menuForAdmin = <<<php
    <li class="menu-list">
        <a class="menu-link" href="?pages=productAdd">Product Add</a>
    </li>
    <li class="menu-list">
        <a class="menu-link" href="?pages=order">Orders</a>
    </li>
php;
}


$file = file_get_contents($dir . "index.html");
$file = str_replace("{CONTENT}", $html, $file);
$file = str_replace("{MESSAGE}", $message, $file);
$file = str_replace("{__MENU_}", $menuForAdmin, $file);
$file = str_replace("{__CART_}", getQuantityCart(), $file);
echo $file;