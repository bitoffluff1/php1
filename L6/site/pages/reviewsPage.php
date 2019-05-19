<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = clearStr($_POST["name"]);
    $text = clearStr($_POST["text"]);
    $sql = "INSERT INTO reviews (name, text) VALUES ('{$name}', '{$text}')";
    mysqli_query(connect(), $sql);
    header("Location: ?page=4");
    exit;
}

$sql = "SELECT name, text, date FROM reviews WHERE id_product IS NULL";
$res = mysqli_query(connect(), $sql);

while ($row = mysqli_fetch_assoc($res)){
    $date = date("d-m-Y", strtotime($row["date"]));

    $feedback .=<<<php
        <div class="feedback">
            <h3 class="bold-text">{$row['name']}</h3>
            <div class="feedback-text">
                <p class="text-material-designer text-material-designer_margin">$date</p>
                <p class="text-details text-details__feedback">{$row['text']}</p>
            </div>
        </div>
php;
}

$html = <<<php
        <div class="feedback-block">
            <div class="feedback-new">
                <div>
                    <h2 class="shopping-cart-forms-text">Send Us Your Feedback</h2>
                    <form method="post">
                        <input class="shopping-cart-forms-input shopping-cart-forms-input_width"
                               placeholder="Name" type="text" name="name">
                        <textarea class="shopping-cart-forms-input textarea_size" placeholder="Your message"
                                  name="text"></textarea>
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

