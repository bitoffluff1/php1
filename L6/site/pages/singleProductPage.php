<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = clearStr($_POST["name"]);
    $text = clearStr($_POST["text"]);
    $id_product = (int)$_POST["id_product"];
    $sql = "INSERT INTO reviews (name, text, id_product) VALUES ('{$name}', '{$text}', '{$id_product}')";
    mysqli_query(connect(), $sql);
    header("Location: ?id=$id&page=2");
    exit;
}


$sql = "SELECT id, address, name, price FROM gallery WHERE id = $id";
$res = mysqli_query(connect(), $sql);
$row = mysqli_fetch_assoc($res);

$sql = "SELECT name, text, date FROM reviews WHERE id_product = $id";
$res = mysqli_query(connect(), $sql);

while ($rowFeedback = mysqli_fetch_assoc($res)){
    $date = date("d-m-Y", strtotime($rowFeedback["date"]));

    $feedback .= <<<php
        <div class="feedback">
            <h3 class="bold-text">{$rowFeedback['name']}</h3>
            <div class="feedback-text">
                <p class="text-material-designer text-material-designer_margin">$date</p>
                <p class="text-details text-details__feedback">{$rowFeedback['text']}</p>
            </div>
        </div>
php;
}


$html = <<<php
      <section class="single-product-box">
            <div class="single-product">
                <img class="img-product" src="{$row['address']}" alt="product">
            </div>

            <div class="box-details-single-product">
                <div class="container details-single-product">
                    <div class="container-single-product">
                        <h3 class="name-product">{$row['name']}</h3>
                        <p class="price">\${$row['price']}</p>
                        <hr class="hr">
                        <div class="choose">
                            <div class="choose-box">
                                <h4 class="choose-title">CHOOSE COLOR</h4>
                                <select class="text-choose" name="color" id="">
                                    <option>Red</option>
                                    <option>Green</option>
                                </select>
                            </div>
                            <div class="choose-box">
                                <h4 class="choose-title">CHOOSE SIZE</h4>
                                <select class="text-choose" name="size" id="">
                                    <option>XXS</option>
                                    <option>XS</option>
                                </select>
                            </div>
                            <div class="choose-box">
                                <h4 class="choose-title">QUANTITY</h4>
                                <input class="input-field" type="number" min="0" value="1">
                            </div>
                        </div>
                        <div class="box-button-add">
                            <a href="#" class="button-add"> <img class="img-cart-pink" src="img/cart-pink.svg"
                                                                 alt="cart">Add to&nbsp;Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="feedback-block">
            <div class="feedback-new">
                <div>
                    <h2 class="shopping-cart-forms-text">Send Us Your Feedback</h2>
                    <form method="post">
                        <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                               placeholder="Name" type="text" name="name">
                        <textarea class="shopping-cart-forms-input textarea_size" placeholder="Your message"
                                  name="text"></textarea>
                        <input type="hidden" value="{$row['id']}" name="id_product">          
                        <input class="button-black shopping-cart-forms-button_size modal_size" type="submit" value="SEND"> 
                    </form> 
                </div>
            </div>

            <div class="container">
                <h2 class="name-product name-product_margin">Reviews</h2>
                $feedback
            </div>
        </div>  
php;


