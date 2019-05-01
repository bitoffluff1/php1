<?php
$data = date("d l Y");

$html = file_get_contents('index.html');
$html = str_replace('{data}', $data , $html);

echo $html;