<?php
function index()
{
    $sql = "SELECT id, address, name, price FROM gallery WHERE stock = '1'";
    $res = mysqli_query(connect(), $sql);


    $html = "<script src='main.js'></script>";
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
                    <div class="add">
                        <p onclick="addItem({$row['id']})" class="add-to-card">
                        <img class="cart-white" src="img/cart-white.svg" alt="cart">Add to Cart</p>
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


