<?php
function index()
{
    $sql = "SELECT id, address, name, price FROM gallery";
    $res = mysqli_query(connect(), $sql);

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
                    <div class="add">
                        <a href="?id={$row['id']}&func=addItem&pages=products" class="add-to-card">
                        <img class="cart-white" src="img/cart-white.svg" alt="cart">Add to Cart</a>
                    </div>
                </div>
php;
    }

    $html = <<<php
                <main>
                    <div class="fetured-items-box container">$item</div>
                </main>
php;

    return $html;
}

function addItem()
{
    notAdmin();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = (int)$_GET["id"];

        $sql = "SELECT id, address, name, price FROM gallery WHERE id = '$id'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        if (!empty($_SESSION["cart"][$row['id']])) {
            $_SESSION["cart"][$row['id']]["quantity"]++;
        } else {
            $_SESSION["cart"][$row['id']] = $row;
            $_SESSION["cart"][$row['id']]["quantity"] = 1;
        }

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

