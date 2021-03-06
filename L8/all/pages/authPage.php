<?php

function index()
{
    //форма для регистрации
    $signUp = <<<php
        <div>
            <h2 class="shopping-cart-forms-text modal_title">SIGN UP</h2>
          
            <form method="post" action="?pages=auth&func=signUp">
                <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                     placeholder="FIO" type="text" name="fio">
                <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                       placeholder="Login" type="text" name="login" required>
                <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                        placeholder="Password" name="password" required>
                <input class="button-black shopping-cart-forms-button_size modal_size" type="submit" value="SIGN UP">
            </form>
        </div>
php;
//если не залогинен, то форма для входа
    if ($_SESSION["adminKey"] != ADMIN_KEY && $_SESSION["login"] != LOGIN) {
        $content = <<<php
           <main class="container auth-flex">
                <div>
                    <h2 class="shopping-cart-forms-text modal_title">SIGN IN</h2>
                  
                    <form method="post" action="?pages=auth&func=login">
                        <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                               placeholder="Login" type="text" required name="login">
                        <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                               placeholder="Password" required name="password">
                        <input class="button-black shopping-cart-forms-button_size modal_size" type="submit" value="SIGN IN">
                    </form>
                </div>
                {$signUp}
           </main>       
php;
    } else { //если залогинен
        $login = "";
        if (!empty($_SESSION["messageSignIn"])) {
            $login = $_SESSION["messageSignIn"];
        }

        $content = <<<php
            <main class="container auth-flex">
                <div>
                    <h2 class="shopping-cart-forms-text modal_title pink">{$login}</h2>
                    <a class="button-black shopping-cart-forms-button_size modal_size" href="?pages=auth&func=logout">Sign Out</a>
                    <a class="button-black shopping-cart-forms-button_size modal_size" href="?pages=userOrders">History orders</a>
                </div>
                {$signUp}
            </main>
php;
    }
    return $content;
}


function login()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = clearStr($_POST["login"]);
        $password = md5($_POST["password"] . SALT);

        $sql = "SELECT id, login, password, role FROM users WHERE login = '$login'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        $_SESSION["messageSignIn"] = "Wrong login or password";

        if ($password == $row["password"]) {
            if ($row["role"] === "isAdmin") {
                $_SESSION["adminKey"] = ADMIN_KEY;
            } else {
                $_SESSION["login"] = LOGIN;
                $_SESSION["userId"] = $row["id"];
            }

            $_SESSION["messageSignIn"] = "Hi, $login";
        }
    }
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}

function signUp()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = clearStr($_POST["login"]);
        $password = md5($_POST["password"] . SALT);

        $sql = "SELECT login FROM users WHERE login = '$login'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        if (!empty($row)) {
            $_SESSION["message"] = "This login is already in use";
            header('Location: ' . $_SERVER["HTTP_REFERER"]);
            exit;
        }

        if (!empty($_SESSION["adminKey"]) || $_SESSION["adminKey"] === ADMIN_KEY) {
            $sql = "INSERT INTO users (login, password, role) VALUES ('{$login}', '{$password}', 'isAdmin')";
            mysqli_query(connect(), $sql);

            $_SESSION["adminKey"] = ADMIN_KEY;
            $_SESSION["messageSignIn"] = "Hi, $login";

            header('Location: ' . $_SERVER["HTTP_REFERER"]);
            exit;
        }

        $sql = "INSERT INTO users (login, password) VALUES ('{$login}', '{$password}')";
        mysqli_query(connect(), $sql);

        $_SESSION["login"] = LOGIN;
        $_SESSION["messageSignIn"] = "Hi, $login";

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}


function logout()
{
    session_destroy();
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}
