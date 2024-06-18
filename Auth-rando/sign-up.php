<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password-confirm"])) {
        $username = trim($_POST["username"]);
        $password = $_POST["password"];
        $password_confirm = $_POST["password-confirm"];
        // CHECK IF PW AND PW confirm match
        if ($password !== $password_confirm) {
            $message = "Password and password confirmation do not match!";
        }
        // CHECK if username already exists within DB return error (unique usernames)
        else {
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare('SELECT username FROM Users WHERE username=:username');
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $message = "Username already in use";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare('INSERT INTO Users (username, password) VALUES
                    (:username, :password)
                    ');
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $hashed_password);
                    $stmt->execute();
                    session_start();
                    $_SESSION["username"] = $username;
                    header("location: read.php");
                }
            } catch (PDOException $e) {
                // Handle database errors
                $message = "Database error: " . $e->getMessage();
            }
        }
    } else {
        $message = "Please fill out all fields";
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
    <h5><?php if (isset($message)) {
        echo $message;
    }
    ?></h5>
    <h2>Register</h2>
    <form method="POST" action="">
        <input style="display:block;" type="text" name="username" id="username" placeholder="Username" required>
        <input style="display:block;" type="password" name="password" id="password" placeholder="Password" required>
        <input style="display:block;" type="password" name="password-confirm" id="password-confirm"
            placeholder="Confirm password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? Click <a href="login.php">Here</a></p>
</body>

</html>