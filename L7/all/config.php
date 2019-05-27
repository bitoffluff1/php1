<?php

const ADMIN_KEY = "__YES__";
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


function notAdmin($message = "Нет доступа")
{
    if (empty($_SESSION["adminKey"]) || $_SESSION["adminKey"] != ADMIN_KEY) {
        $_SESSION["message"] = $message;
        header("Location: ?pages=auth");
        exit();
    }
}