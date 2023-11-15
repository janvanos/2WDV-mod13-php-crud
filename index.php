<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<form action="" method="post">
<input type="text" name="search">
</form>

    <?php


    include 'connect.php';

$search = $_REQUEST['search'];
$filter = " WHERE project_name LIKE '%".$search."%' OR descr_short LIKE '%".$search."%' OR desc_long LIKE '%".$search."%'";

$page = $_REQUEST['p'];
$limit = " LIMIT 0,5";
if(isset($_REQUEST['p'])){
$limit = " LIMIT " . $_REQUEST['p'] . ",5";
}

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, project_name, descr_short FROM projecten".$filter.$limit);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            echo "<a href='detail.php?project=" . $v['id'] . "'>view detials</a>";
            echo "<a href='edit.php?project=" . $v['id'] . "'>edit details</a>";
            echo $v['id'] . ": ";
            echo $v['project_name'];
            echo " - " . $v['descr_short'];
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
<a href="">1</a>
<a href="?p=1">2</a>
<a href="?p=2">3</a>
</body>

</html>