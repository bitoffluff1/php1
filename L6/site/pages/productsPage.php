<?php
$sql = "SELECT id, address, name, price FROM gallery";
$res = mysqli_query(connect(), $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $item .= <<<php
                <div class="item">
                    <div class="fetured-item1">
                        <a href="?id={$row['id']}&page=2" class="fetured-item">
                           <img src="{$row['address']}" alt="fetured-items">
                           <div class="item-text">
                               <p class="name-item">{$row['name']}</p>
                               <p class="pink-item">\${$row['price']}</p>
                           </div>
                        </a>
                    </div>
                    <div class="add">
                        <a href="#" class="add-to-card">
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

