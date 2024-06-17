<?php

try {
    // Connection to MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM weather');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // ADDS ENTRY TO DB
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["city"]) && isset($_POST["low"]) && isset($_POST["high"])) {
            $query = $pdo->prepare("INSERT INTO weather (city, high, low) VALUES (:city, :high, :low)");
            $query->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
            $query->bindParam(':high', $_POST['high'], PDO::PARAM_INT);
            $query->bindParam(':low', $_POST['low'], PDO::PARAM_INT);
            if (!$query->execute()) {
                echo "something went wrong";
            } else {
                header('Location: ' . $_SERVER['PHP_SELF']);
            }

        }
        // DELETES DB ENTRY IF CITY IS TICKED
        foreach ($results as $row) {
            $city = $row['city'];
            if (isset($_POST[$city]) && $_POST[$city] === "on") {
                $query2 = $pdo->prepare("DELETE FROM weather WHERE city=:city_delete");
                $query2->bindParam(":city_delete", $city, PDO::PARAM_STR);
                if (!$query2->execute()) {
                    echo "Could not delete city";
                } else {
                    header('Location: ' . $_SERVER['PHP_SELF']);
                }
            }
        }
    }
} catch (Exception $e) {
    // shut down in case there is a connection error.
    die('ERROR : ' . $e->getMessage());
}

?>

<h1>Weather</h1>
<form action="" method="POST">
    <table>
        <thead>
            <tr>
                <th>City</th>
                <th>Low</th>
                <th>High</th>
            </tr>

        </thead>
        <tbody>

            <?php
            foreach ($results as $row): ?>
                <tr>
                    <td><input type="checkbox" name="<?php echo $row['city']; ?>"></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['low']; ?></td>
                    <td><?php echo $row['high']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <input type="text" name="city" placeholder="City" required>
    <input type="number" name="low" placeholder="Low" required>
    <input type="number" name="high" placeholder="High" required>
    <button type="submit">Add</button>
</form>