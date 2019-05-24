<?php

function index()
{
    $message = "";
    if (!empty($_SESSION["message"])) {
        $message = "<h2 class='shopping-cart-forms-text modal_title pink'>{$_SESSION["message"]}</h2>";
        unset($_SESSION["message"]);
    }

    $messageSignUp = "";
    if (!empty($_SESSION["messageSignUp"])) {
        $messageSignUp = "<h2 class='shopping-cart-forms-text modal_title pink'>{$_SESSION["messageSignUp"]}</h2>";
        unset($_SESSION["messageSignUp"]);
    }

    $signUp = <<<php
        <div>
            <h2 class="shopping-cart-forms-text modal_title pink">{$messageSignUp}</h2>
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


    if ($_SESSION["adminKey"] != ADMIN_KEY) {
        $content = <<<php
           <main class="container auth-flex">
                <div>
                    <h2 class="shopping-cart-forms-text modal_title pink">{$message}</h2>
                    <h2 class="shopping-cart-forms-text modal_title">SIGN IN</h2>
                  
                    <form method="post" action="?pages=auth&func=login">
                        <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                               placeholder="Login" type="text" required name="login">
                        <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                               placeholder="Password" required name="password">
                        <input class="button-black shopping-cart-forms-button_size modal_size" type="submit" value="SIGN IN">
                    </form>
                </div>
                $signUp
           </main>       
php;
    } else {
        if (!empty($_SESSION["messageSignIn"])) {
            $message = $_SESSION["messageSignIn"];
        }

        $content = <<<php
            <main class="container auth-flex">
                <div>
                    <h2 class="shopping-cart-forms-text modal_title pink">{$message}</h2>
                    <a href="?pages=auth&func=logout">Sign Out</a>
                </div>
                $signUp
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

        $sql = "SELECT id, fio, login, password, date FROM users WHERE login = '$login'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        $_SESSION["messageSignIn"] = "Wrong login or password";

        if ($password == $row["password"]) {
            $_SESSION["adminKey"] = ADMIN_KEY;
            $_SESSION["messageSignIn"] = "Hi, {$_POST["login"]}";
        }

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

function signUp()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = clearStr($_POST["login"]);
        $password = md5($_POST["password"] . SALT);

        $sql = "SELECT id, fio, login, password, date FROM users WHERE login = '$login'";

        if(!empty($sql)){
            $_SESSION["messageSignUp"] = "This login is already in use";
            header('Location: ' . $_SERVER["HTTP_REFERER"]);
            exit;
        }

        $sql = "INSERT INTO users (login, password) VALUES ('{$login}', '{$password}')";
        mysqli_query(connect(), $sql);

        $_SESSION["adminKey"] = ADMIN_KEY;
        $_SESSION["messageSignIn"] = "Hi, {$_POST["login"]}";

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

function logout()
{
    $_SESSION["adminKey"] = "";
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}