<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password-confirm"])) {
        $password = $_POST["password"];
        $username = $_POST["username"];
        $password_confirm = $_POST["password-confirm"];
        // CHECK IF PW AND PW confirm match
        if ($password !== $password_confirm) {
            $message = "Password and password confirmation do not match!";
        }
        // CHECK if username already exists within DB return error (unique usernames)
        $pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $username = $stmt->fetch(PDO::FETCH_ASSOC);
        $message = "Username already in use";
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