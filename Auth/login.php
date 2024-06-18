<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST["password"]) && isset($_POST["username"])) {
        // SEARCH DB to check credentials validity
        $username = $_POST["username"];
        $password = $_POST["password"];
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('SELECT * FROM Users WHERE username=:username && password=:password;');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $user;
            if (!$user) {
                echo "<h6>Invalid credentials</h6>";
            } else {
                // Initiates session and redirects to homepage
                session_start();
                $_SESSION["username"] = $user["username"];
                header("Location: read.php");
                exit();
            }
        } catch (PDOException $e) {
            echo '' . $e->getMessage();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <title>Randonnées</title>
        <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
    </head>
</head>

<body>
    <h2>Log In</h2>
    <form method="POST" action="">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <button type="submit">Log In</button>
    </form>
    <p>Not registered yet? Click <a href="sign-up.php">Here</a></p>
</body>

</html>