<?php
function index()
{
    if ($_SESSION["login"] = LOGIN && !empty($_SESSION["userId"])) {
        $id = (int)$_SESSION["userId"];

        $sql = "SELECT id, date, comments, order_items, status FROM orders WHERE user_id = $id ORDER BY id DESC";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        if (empty($row)) {
            return "<h2 class='shopping-cart-forms-text modal_title pink center'>Empty</h2>";
        }
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
    return "For users";
}