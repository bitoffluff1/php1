<?php
function index()
{
    $message = "";
    if (!empty($_SESSION["message"])) {
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
    }

    $html = <<<php
        <div class="shopping-cart-forms container">
            <div class="shipping-address">
                <h2 class="shopping-cart-forms-text">Product Add</h2>
                
                <p class="shopping-cart-forms-text pink">{$message}</p>
                <form method="post" enctype="multipart/form-data" action="?pages=productAdd&func=productAdd">
                    <input class="shopping-cart-forms-input shopping-cart-forms-input_width" 
                        placeholder="Name" name="name" type="text">
                    <input class="shopping-cart-forms-input shopping-cart-forms-input_width" 
                        placeholder="Price" name="price" type="text">
                    <input class="custom-file-input"  type="file" name="userfile"><br>   
                    <input type="submit" class="button-black shopping-cart-forms-button_size" value="Add">
                </form>
                
            </div>
        </div>
php;
    return $html;
}

function productAdd()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $file = PUBLIC_DIR . "/img/{$_FILES['userfile']['name']}";
        copy($_FILES['userfile']['tmp_name'], $file);

        $address = clearStr("img/{$_FILES['userfile']['name']}");
        $name = clearStr($_POST["name"]);
        $price = (int)($_POST["price"]);

        $sql = "INSERT INTO gallery (address, name, price) VALUES ('{$address}', '{$name}', '{$price}')";
        mysqli_query(connect(), $sql);

        $_SESSION["message"] = "Product added";

        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}