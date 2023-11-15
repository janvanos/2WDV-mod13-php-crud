<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    if (isset($_POST['submit'])) {

        include 'connect.php';

        try {
            $sql = "INSERT INTO projecten (project_name, descr_short, desc_long, timeframe, type, githubrepo, image, url)
        VALUES ('" . $_POST['project_name'] . "',
        '" . $_POST['descr_short'] . "',
        '" . $_POST['desc_long'] . "',
        '" . $_POST['timeframe'] . "',
        '" . $_POST['type'] . "',
        '" . $_POST['githubrepo'] . "',
        '" . $_POST['image'] . "',
        '" . $_POST['url'] . "')";
            $conn->exec($sql);
            echo "New record created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    ?>

    <form action="" method="post">
        <input type="text" name="project_name">
        <input type="text" name="descr_short">
        <input type="text" name="desc_long">
        <input type="date" name="timeframe">
        <input type="text" name="type">
        <input type="text" name="githubrepo">
        <input type="text" name="image">
        <input type="text" name="url">
        <input type="submit" name="submit">

    </form>
    <a href="index.php">terug</a>
</body>

</html>