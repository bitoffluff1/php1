<?php

const ADMIN_KEY = "_ADMIN_";
const LOGIN = "__YES__";
const SALT = "ds1fe3atv435dafs435rf";

function connect()
{
    static $link;
    if (empty($link)) {
        $link = mysqli_connect("localhost", "root", "", "gbphp");
    }
    return $link;
}

function clearStr($str)
{
    return mysqli_real_escape_string(connect(), strip_tags(trim($str)));
}


function notAdmin($message = "Only for admin")
{
    if (empty($_SESSION["adminKey"]) || $_SESSION["adminKey"] != ADMIN_KEY) {
        $_SESSION["message"] = $message;
        header("Location: ?pages=auth");
        exit();
    }
}

function getQuantityCart()
{
    $quantity = 0;
    if (!empty($_SESSION["cart"])) {
        $quantity = 0;
        foreach ($_SESSION["cart"] as $id => $item) {
            $quantity += $item["quantity"];
        }
    }
    return $quantity;
}