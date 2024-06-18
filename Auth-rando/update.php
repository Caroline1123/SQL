<?php

session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}



if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('SELECT * FROM hiking WHERE id=:id;');
        $stmt->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results = $results[0];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["name"]) && isset($_POST["duration"]) && isset($_POST["distance"]) && isset($_POST["height_difference"])) {
                $stmt = $pdo->prepare('UPDATE hiking SET name=:name, difficulty=:difficulty, distance=:distance, duration=:duration, height_difference=:height_difference
                WHERE id=:id;');
                $stmt->bindValue(":id", $id);
                $stmt->bindValue(":name", $_POST["name"], PDO::PARAM_STR);
                $stmt->bindValue(":difficulty", $_POST["difficulty"], PDO::PARAM_STR);
                $stmt->bindValue(":distance", $_POST["distance"], PDO::PARAM_STR);
                $stmt->bindValue(":duration", $_POST["duration"], PDO::PARAM_STR);
                $stmt->bindValue(":height_difference", $_POST["height_difference"], PDO::PARAM_STR);
                $stmt->execute();
                $message = "Update successful ! ";
            }
        }

    } catch (PDOException $e) {
        die('ERROR :' . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ajouter une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <?php if (isset($message)) {
        echo '<h5>' . $message . '</h5>';
    }
    ?>
    <a href="read.php">Data List</a>
    <h1>Update</h1>
    <form action="" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $results['name'] ?>" required>
        </div>
        <div>
            <label for="difficulty">Difficulty</label>
            <select name="difficulty">
                <option value="very easy" <?php echo ($results['difficulty'] == "very easy") ? 'selected' : '' ?>>Very
                    Easy</option>
                <option value="easy" <?php echo ($results['difficulty'] == "easy") ? 'selected' : '' ?>>Easy</option>
                <option value="average" <?php echo ($results['difficulty'] == "average") ? 'selected' : '' ?>>Average
                </option>
                <option value="difficult" <?php echo ($results['difficulty'] == "difficult") ? 'selected' : '' ?>>
                    Difficult</option>
                <option value="very difficult" <?php echo ($results['difficulty'] == "very difficult") ? 'selected' : '' ?>>Very Difficult</option>
            </select>
        </div>

        <div>
            <label for="distance">Distance</label>
            <input type="text" name="distance" value="<?php echo $results['distance'] ?>" required>
        </div>
        <div>
            <label for="duration">Duration</label>
            <input type="time" name="duration" value="<?php echo $results['duration'] ?>" required>
        </div>
        <div>
            <label for="height_difference">Height Difference</label>
            <input type="text" name="height_difference" value="<?php echo $results['height_difference'] ?>" required>
        </div>
        <button type="submit" name="button">Update</button>
    </form>
</body>

</html>