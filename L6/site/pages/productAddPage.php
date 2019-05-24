<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = PUBLIC_DIR . "/img/{$_FILES['userfile']['name']}";
    copy($_FILES['userfile']['tmp_name'], $file);

    $address = clearStr("img/{$_FILES['userfile']['name']}");
    $name = clearStr($_POST["name"]);
    $price = clearStr($_POST["price"]);
    $sql = "INSERT INTO gallery (address, name, price) VALUES ('{$address}', '{$name}', '{$price}')";
    mysqli_query(connect(), $sql);
    header("Location: ?page=3");
    exit;
}


$html = <<<php
        <div class="shopping-cart-forms container">
            <div class="shipping-address">
                <h2 class="shopping-cart-forms-text">Product Add</h2>
                <form method="post" enctype="multipart/form-data">
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


