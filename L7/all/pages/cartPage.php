<?php
function index()
{
    if (!empty($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $item) {
            $sum = $item['price'] * $item['quantity'];
            $items .= <<<php
                 <div class= "row row-product">
                     <div class="col col-1 row_first">
                         <figure class="col-1__product">
                             <a href="#"><img src="{$item['address']}" alt="item" class="cart-item-img"></a>
                             <figcaption class="col-1__text">
                             <a href="#" class="shopping-cart-product-text">{$item['name']}</a>
                             <p class="shopping-cart-product-text-bottom">
                                 <span class="bold">Color: </span>
                                 <span>Black</span></p>
                             <p class="shopping-cart-product-text-bottom">
                                 <span class="bold">Size: </span>
                                 <span>XS</span></p>
                             </figcaption>
                         </figure>
                     </div>
                     <div class="col col-2">\${$item['price']}</div>
                     <div class="col col-3">
                         <div>
                            <a href="?id={$item['id']}&pages=cart&func=lessItem" class="button-black quantity-button_size">-</a>
                                {$item['quantity']}   
                            <a href="?id={$item['id']}&pages=cart&func=moreItem" class="button-black quantity-button_size">+</a>
                         </div>
                     </div>
                     <div class="col col-4">FREE</div>
                     <div class="col col-5">\$$sum</div>
                     <div class="col col-6 row-header__last row-header__last_center">
                         <a href="?id={$item['id']}&pages=cart&func=deleteItem" class="delete-cart-item">
                         <i class="fas fa-times-circle"></i></a></div>
                 </div>
php;
        }
    }


    $html = <<<php
        <div class="shopping-cart-table container">
            <div class="row row-header">
                <div class="col col-1 row-header__col row_first">Product details</div>
                <div class="col row-header__col">unite price</div>
                <div class="col row-header__col">quantity</div>
                <div class="col row-header__col">shipping</div>
                <div class="col row-header__col">subtotal</div>
                <div class="col row-header__col row-header__last">action</div>
            </div>
            <div class="cart">$items</div>
            <div class="shopping-cart-table-button">
                <a href="#" class="button-black shopping-cart-table-button_size" id="clear-cart">cLEAR SHOPPING
                    CART </a>
                <a href="#" class="button-black shopping-cart-table-button_size">cONTINUE sHOPPING </a>
            </div>
        </div>
php;
    return $html;
}

function deleteItem()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = (int)$_GET["id"];

        if (!empty($_SESSION["cart"][$id])) {
            unset($_SESSION["cart"][$id]);
        }

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

function moreItem()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = (int)$_GET["id"];

        if (!empty($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]['quantity']++;
        }

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

function lessItem()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = (int)$_GET["id"];

        if (!empty($_SESSION["cart"][$id])) {
            $quantity = $_SESSION["cart"][$id]['quantity'];

            if ($quantity == 1) {
                unset($_SESSION["cart"][$id]);
            } else {
                $_SESSION["cart"][$id]['quantity'] = $quantity - 1;
            }
        }

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}


