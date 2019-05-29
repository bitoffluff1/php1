<?php
function index()
{
    if (empty($_SESSION["cart"])) {
        return "<h2 class='shopping-cart-forms-text modal_title pink center'>Cart empty</h2>";
    }

    $items = "";
    $total = 0;
    foreach ($_SESSION["cart"] as $id => $item) {
        $sum = $item['price'] * $item['quantity'];
        $total += $sum;
        $items .= <<<php
                 <div class= "row row-product">
                     <div class="col col-1 row_first">
                         <figure class="col-1__product">
                             <a href="?id={$id}&pages=singleProduct"><img src="{$item['address']}" alt="item" class="cart-item-img"></a>
                             <figcaption class="col-1__text">
                             <a href="?id={$id}&pages=singleProduct" class="shopping-cart-product-text">{$item['name']}</a>
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
                            <a href="?id={$id}&pages=cart&func=deleteItem" class="button-black quantity-button_size">-</a>
                                {$item['quantity']}   
                            <a href="?id={$id}&pages=cart&func=addItem" class="button-black quantity-button_size">+</a>
                         </div>
                     </div>
                     <div class="col col-4">FREE</div>
                     <div class="col col-5">\$$sum</div>
                     <div class="col col-6 row-header__last row-header__last_center">
                         <a href="?id={$id}&pages=cart&func=deleteItem&item=all" class="delete-cart-item">
                         <i class="fas fa-times-circle"></i></a></div>
                 </div>
php;
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
                <a href="?pages=cart&func=clearCart" class="button-black shopping-cart-table-button_size" id="clear-cart">cLEAR SHOPPING
                    CART </a>
                <a href="?pages=cart&next=checkout" class="button-black shopping-cart-table-button_size">cONTINUE sHOPPING </a>
            </div>
        </div>
php;

    if ($_GET["next"] === "checkout") {
        $html .= <<<php
        <div class="shopping-cart-forms container">
            <form class="proceed-to-checkout" method="post" action="?pages=order&func=addOrder">
                <textarea name="comment" placeholder="Shipping Address"
                    cols="40" rows="5"></textarea>
                <div class="proceed-to-checkout-text">
                    <p class="proceed-to-checkout-text-bottom">GRAND TOTAL <span class="pink">\${$total}</span></p>
                </div>
                <input class="button-pink proceed-to-checkout-button_size" value="checkout" type="submit">
            </form>
        </div>
php;
    }
    return $html;
}


function deleteItem()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = (int)$_GET["id"];

        if (!empty($_SESSION["cart"][$id])) {
            $quantity = $_SESSION["cart"][$id]['quantity'];

            if ($quantity == 1 || $_GET["item"] === "all") {
                unset($_SESSION["cart"][$id]);
            } else {
                $_SESSION["cart"][$id]['quantity'] = $quantity - 1;
            }
        }
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

function addItem()
{
    $id = (int)$_GET["id"];

    if (!empty($id)) {
        $sql = "SELECT address, name, price FROM gallery WHERE id = $id";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        if (!empty($row)) {
            if (!empty($_SESSION["cart"][$id])) {
                $_SESSION["cart"][$id]["quantity"]++;
            } else {
                $_SESSION["cart"][$id] = [
                    "address" => $row["address"],
                    "name" => $row["name"],
                    "price" => $row["price"],
                    "quantity" => 1
                ];
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $quantity = getQuantityCart();
        echo $quantity;
        exit;
    }

    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}

function clearCart()
{
    unset($_SESSION["cart"]);
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}
