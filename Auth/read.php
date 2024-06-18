<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM hiking;');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('ERROR :' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <a href="create.php" style="padding-right:5px;">Create walk</a>
    <a href="login.php" style="padding-right:5px;">Log In</a>
    <a href="sign-up.php" style="padding-right:5px;">Sign Up</a>

    <h1>Liste des randonnées</h1>
    <table>
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Difficulty
                </th>
                <th>
                    Distance(km)
                </th>
                <th>
                    Duration(hours)
                </th>
                <th>
                    Height difference (meters)
                </th>
            </tr>
        </thead>
        <!-- Afficher la liste des randonnées -->
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td> <?php echo $row["name"] ?> </td>
                    <td> <?php echo $row["difficulty"] ?> </td>
                    <td> <?php echo $row["distance"] ?> </td>
                    <td> <?php echo $row["duration"] ?> </td>
                    <td> <?php echo $row["height_difference"] ?> </td>
                    <td>
                        <form action="update.php" method="get">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]) ?>">
                            <button type="submit">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="get">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]) ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>