<?php
const PUBLIC_DIR = __DIR__;

include ("config.php");

$page = (int)$_GET["page"];
$id = (int)$_GET["id"];

switch ($page){
    case 1: include ("pages/productsPage.php"); break;
    case 2: include ("pages/singleProductPage.php"); break;
    case 3: include ("pages/productAddPage.php"); break;
    case 4: include ("pages/reviewsPage.php"); break;
    default: include ("pages/productsPage.php"); break;
}

$file = file_get_contents("index.html");
echo str_replace("{CONTENT}", $html, $file);
