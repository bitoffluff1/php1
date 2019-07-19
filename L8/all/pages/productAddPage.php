<?php
function index()
{
    notAdmin();

    $html = <<<php
        <div class="shipping-address container">
            <h2 class="shopping-cart-forms-text">Product Add</h2>
            <form method="post" enctype="multipart/form-data" action="?pages=productAdd&func=productAdd">
                <input class="shopping-cart-forms-input shopping-cart-forms-input_width" 
                    placeholder="Name" name="name" type="text">
                <input class="shopping-cart-forms-input shopping-cart-forms-input_width" 
                    placeholder="Price" name="price" type="text">
                <input class="custom-file-input"  type="file" name="userfile"><br>   
                <input type="submit" class="button-black shopping-cart-forms-button_size" value="Add">
            </form>
        </div>
php;

    $sql = "SELECT id, address, name, price FROM gallery WHERE stock = '1'";
    $res = mysqli_query(connect(), $sql);

    $item = "";
    while ($row = mysqli_fetch_assoc($res)) {
        $item .= <<<php
            <div class="item">
                 <div class="fetured-item1">
                     <a href="?id={$row['id']}&pages=singleProduct" class="fetured-item">
                        <img src="{$row['address']}" alt="fetured-items">
                        <div class="item-text">
                            <p class="name-item">{$row['name']}</p>
                            <p class="pink-item">\${$row['price']}</p>
                        </div>
                     </a>
                 </div>
                 <div class="change-products-box">
                     <form class="change-products" method="post" action="?pages=productAdd&func=changeName">
                        <input class="product-form product-form_input"
                             placeholder="New name" type="text" name="name">
                        <input type="hidden" name="id" value="{$row['id']}">
                        <input class="product-form product-form_submit" type="submit" value="submit">
                     </form>
                    <form class="change-products" method="post" action="?pages=productAdd&func=changePrice">
                        <input class="product-form product-form_input"
                               placeholder="New price" type="text" name="price">
                        <input type="hidden" name="id" value="{$row['id']}">
                        <input class="product-form product-form_submit" type="submit" value="submit">
                    </form>
                    <a class="product-form product-form_submit product-form_margin" href="?pages=productAdd&func=delete&id={$row['id']}">delete</a>
                </div>
            </div>
php;
    }

    $html .= <<<php
                <main>
                    <h2 class='heading'>All products</h2>
                    <div class="fetured-items-box container">$item</div>
                </main>
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

function changeName()
{
    $message = "Something wrong";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = clearStr($_POST["name"]);
        $id = (int)$_POST["id"];

        if (!empty($name)) {
            $sql = "UPDATE gallery SET name = '{$name}' WHERE id = $id";
            mysqli_query(connect(), $sql);
            $message = "";
        }
    }
    $_SESSION["message"] = $message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

function changePrice()
{
    $message = "Something wrong";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $price = (int)$_POST["price"];
        $id = (int)$_POST["id"];

        if (!empty($price)) {
            $sql = "UPDATE gallery SET price = '{$price}' WHERE id = $id";
            mysqli_query(connect(), $sql);
            $message = "";
        }
    }
    $_SESSION["message"] = $message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

function delete()
{
    $message = "Something wrong";

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $id = (int)$_GET["id"];

        $sql = "UPDATE gallery SET stock = '0' WHERE id = $id";
        mysqli_query(connect(), $sql);
        $message = "";
    }
    $_SESSION["message"] = $message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

