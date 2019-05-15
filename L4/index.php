<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        img {
            margin: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 600px;
            max-width: 100%;
            height: 300px;
            max-height: 100%;
            position: fixed;
            z-index: 100;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #f5f3f3;
            padding: 40px;
        }

        .fas_modal {
            position: absolute;
            right: 40px;
            top: 40px;
            color: black;
        }

        .modal_main {
            display: flex;
            justify-content: center;
        }

    </style>
</head>
<body>
<div>
    <h3>Создаем картинки перебором названий</h3>
    <?php
    for ($i = 1; $i < 10; $i++) {
        echo "<a href='img/product-$i.jpg' target='_blank'><img style='width:132px; height:140px' 
                                                                    src='img/product-$i.jpg' 
                                                                    alt='картинка'></a>";
    }
    ?>
</div>

<div>
    <h3>Достаем картинки из папки и открываем при клике в новом окне</h3>
    <?php
    $images = scandir('img');
    foreach ($images as $key => $img) {
        if (strlen($img) > 2) {
            echo "<a href='img/$img' target='_blank'><img style='width:132px; height:140px' src='img/$img' alt='картинка'></a>";
        }
    }
    ?>
</div>

<div id="images">
    <h3>Достаем картинки из папки и открываем при клике в модальном окне</h3>
    <?php
    $images = scandir('img');
    foreach ($images as $key => $img) {
        if ($img != '.' && $img != '..') {
            echo "<a href='img/$img'><img style='width:132px; height:140px' src='img/$img' alt='картинка'></a>";
        }
    }
    ?>
</div>

<div class="modal">
    <div class="modal-content">
        <a href="#"><i class="fas fa-times-circle fas_modal"></i></a>
        <main class="modal_main">

        </main>
    </div>
</div>

<script>
    window.onload = function () {
        const $images = document.getElementById("images");
        const $modal = document.querySelector(".modal");
        const $modalImg = document.querySelector(".modal_main");

        $images.addEventListener("click", (event) => {
            event.preventDefault();

            if (event.target.tagName !== "IMG") return;

            $modal.style.display = "block";

            const $src = event.target.src;
            const $image = document.createElement("img");
            $image.src = $src;

            $modalImg.innerHTML = "";
            $modalImg.appendChild($image);
        });


        const $close = document.querySelector(".fas_modal");
        $close.addEventListener("click", () => {
            $modal.style.display = "none";
        });
    }
</script>


<?php
//Задание с записью статистики

$date = date("d F Y G:i");

$file = fopen("log.txt", "a");
fwrite($file, $date . "\n\r");
fclose($file);
?>


<?php
$date = date("d F Y G:i");

$file = fopen("log.txt", "a");

$text = file_get_contents("log.txt");
fwrite($file, $date . "\n\r");

$data = explode("\n\r", $text);
if (count($data) >= 10) {
    //второй вариант поиска файла складывать все файлы log в одну папку и определяем кол-во файлов в папке
    //$dir = __DIR__ . '/img/';
    //$count = count(scandir($dir)) - 2;

    $files = scandir(__DIR__);

    $arr = [];
    foreach ($files as $name) {
        if (preg_match("/^log[0-9]?.txt$/", $name, $matches)) {
            $arr[] = $matches[0];
        }
    }
    $length = count($arr);

    copy("log.txt", "log{$length}.txt");
    file_put_contents("log.txt", "");
}

fclose($file);
?>




</body>
</html>