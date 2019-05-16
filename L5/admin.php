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
    </style>
</head>
<body>

<div>
    <?php
    if (!empty($_GET["address"])) {
        $address = $_GET["address"];
        $link = mysqli_connect("localhost", "root", "", "gbphp");
        $sql = "INSERT INTO gallery (address) VALUES ('{$address}')";
        if (!empty($_GET["name"])) {
            $name = $_GET["name"];
            $sql = "INSERT INTO gallery (address, name) VALUES ('{$address}', '{$name}')";
        }
        mysqli_query($link, $sql);
    }
    ?>

    <a href="index.php">Вернуться ко всем картинкам</a>
    <form>
        <h2>Добавить файл в базу данных</h2>
        <input name="address" placeholder="Путь к файлу" required>
        <input name="name" placeholder="Название файла">
        <input type="submit">
    </form>
</div>

</body>
</html>
