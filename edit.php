<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'connect.php';

    $project_name = "";
    $descr_short = "";
    $desc_long = "";
    $timeframe = "";
    $type = "";
    $githubrepo = "";
    $image = "";
    $url = "";
    $project = $_GET['project'];

    if (isset($_POST['submit'])) {
        include 'connect.php';


        try {
            $sql = "UPDATE projecten SET project_name = '" . $_POST['project_name'] . "', descr_short = '" . $_POST['descr_short'] . "', desc_long = '" . $_POST['desc_long'] . "', timeframe = '" . $_POST['timeframe'] . "', type = '" . $_POST['type'] . "', githubrepo = '" . $_POST['githubrepo'] . "', image = '" . $_POST['image'] . "', url = '" . $_POST['url'] . "' WHERE id = " . $project;
            $conn->exec($sql);
            echo "Updated record successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM projecten WHERE id = " . $project);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            $project_name = $v['project_name'];
            $descr_short = $v['descr_short'];
            $desc_long = $v['desc_long'];
            $timeframe = $v['timeframe'];
            $type = $v['type'];
            $githubrepo = $v['githubrepo'];
            $image = $v['image'];
            $url = $v['url'];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;



    ?>

    <form action="" method="post">
        <input type="text" name="project_name" value="<?php echo $project_name; ?>">
        <input type="text" name="descr_short" value="<?php echo $descr_short; ?>">
        <input type="text" name="desc_long" value="<?php echo $desc_long; ?>">
        <input type="date" name="timeframe" value="<?php echo $timeframe; ?>">
        <input type="text" name="type" value="<?php echo $type; ?>">
        <input type="text" name="githubrepo" value="<?php echo $githubrepo; ?>">
        <input type="text" name="image" value="<?php echo $image; ?>">
        <input type="text" name="url" value="<?php echo $url; ?>">
        <input type="submit" name="submit">

    </form>
    <a href="index.php">terug</a>
</body>

</html>