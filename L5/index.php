<?php
$link = mysqli_connect("localhost", "root", "", "gbphp");

//удаляем картинку
if (!empty($_GET["id"])&& empty($_GET["name"])) {
    $id = (int)$_GET["id"];
    $sql = "DELETE FROM gallery WHERE id = $id";
    mysqli_query($link, $sql);
    header("Location: http://php1/L5/index.php");
    exit();
}

//меняем имя картинки
if (!empty($_GET["name"])) {
    $name = $_GET["name"];
    $id = (int)$_GET["id"];
    $sql = "UPDATE gallery SET name = '{$name}' WHERE id = $id";
    mysqli_query($link, $sql);
}
?>


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
            flex-direction: column;
        }

        .flex {
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
<?php
$sql = "SELECT id, address, name FROM gallery ORDER BY gallery.count DESC";
$res = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $html .= <<<php
        <div class="box">
            <a href='single-page.php?id={$row['id']}'>
                <img style='width:132px; height:140px' src='{$row['address']}' alt='{$row['name']}'>
            </a>
            <h3>{$row['name']}</h3>
            <a href='?id={$row['id']}'>Удалить</a>
            <form>
                <p>Изменить название:</p>
                <input name="name" placeholder="Название файла">
                <input name="id" value="{$row['id']}" type="hidden">
                <input type="submit">
            </form>
        </div>
php;
}
echo "<a href=\"admin.php\">Admin</a>";
echo "<div class='flex'>$html</div>";
?>
</body>
</html>