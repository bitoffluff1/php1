<?php
function index()
{
    notAdmin();

    $sql = "SELECT id, user_id, date, comments, order_items, status FROM orders ORDER BY id DESC";
    $res = mysqli_query(connect(), $sql);

    $orders = "";
    while ($row = mysqli_fetch_assoc($res)) {
        $orderItems = json_decode($row["order_items"], true);

        $items = "";
        $total = 0;
        foreach ($orderItems as $id => $item) {
            $total += $item['price'] * $item['quantity'];
            $items .= <<<php
                 <div class="item">
                    <a href="?id={$id}&pages=singleProduct" class="fetured-item">
                       <img src="{$item['address']}" alt="fetured-items">
                       <div class="item-text">
                           <p class="name-item">{$item['name']}</p>
                           <p class="name-item">Quantity: {$item["quantity"]}</p>
                           <p class="pink-item">\${$item['price']}</p>
                       </div>
                    </a>
                 </div>
php;
        }
        $orders .= <<<php
             <div class="order">
                 <div class="orders_center">
                     <h2 class="shopping-cart-forms-text modal_title pink shopping-cart-forms-text_margin">Order status: {$row['status']}</h2>
                     <form action="?pages=order&func=changeStatus" method="post">
                        <select class="text-choose text-choose_margin" name="status">
                            <option value="inWork">In work</option>
                            <option value="sent">Sent</option> 
                        </select>
                        <input type="hidden" name="id" value="{$row['id']}">
                        <input class="button-black shopping-cart-forms-button_size" type="submit" value="CHANGE">
                     </form>
                 </div>
                 
                 <h2 class="shopping-cart-forms-text modal_title center">Order NO.: {$row['id']}</h2> 
                 <p class="text-bottom-fetured-items">ORDER DATE: {$row['date']}</p>
                 <main>
                     <div class="fetured-items-box container">$items</div>
                 </main>
                 <h2 class="shopping-cart-forms-text modal_title center">ORDER TOTAL: <span class="pink">\${$total}</span></h2>
                 <hr class="hr">
             </div>
php;
    }

    $content = <<<php
            <div class="container">
                <h2 class='heading'>All orders</h2>
                <div class="orders">$orders</div>
            </div>
php;

    return $content;
}

function addOrder()
{
    $message = "Something wrong";

    if ($_SESSION["login"] != LOGIN && empty($_SESSION["userId"])) {
        $message = "Login to place an order";
        $_SESSION["message"] = $message;
        header("Location: ?pages=auth");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user_id = (int)$_SESSION["userId"];
        $comment = clearStr($_POST["comment"]);
        $order_items = json_encode($_SESSION["cart"], JSON_UNESCAPED_UNICODE);

        $sql = "INSERT INTO orders (user_id, comments, order_items) VALUES ('{$user_id}', '{$comment}', '{$order_items}')";
        mysqli_query(connect(), $sql);

        unset($_SESSION["cart"]);
        $message = "Order is accepted. His number: " . mysqli_insert_id(connect());
    }
    $_SESSION["message"] = $message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

function changeStatus()
{
    $message = "Something wrong";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = (int)$_POST["id"];
        $status = clearStr($_POST["status"]);

        $sql = "UPDATE orders SET status = '{$status}' WHERE id = $id";
        mysqli_query(connect(), $sql);
        $message = "";
    }
    $_SESSION["message"] = $message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}