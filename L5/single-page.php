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

        .box {
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<a href="index.php">Вернуться ко всем картинкам</a>

<?php
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    $link = mysqli_connect("localhost", "root", "", "gbphp");
    $sql = "UPDATE gallery SET count = count + iwu  WHERE id = $id";
    mysqli_query($link, $sql);
    $sql = "SELECT id, address, name, count FROM gallery WHERE id = $id";
    $res = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($res);
    echo <<<php
            <div class='box'><img src='{$row['address']}' alt='{$row['name']}'></div>
            <h3 class='box'>Количество просмотров: {$row['count']}</h3>
php;
}
?>


</body>
</html>
