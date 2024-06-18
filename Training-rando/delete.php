<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('DELETE FROM hiking WHERE id=:id;');
        $stmt->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
        $stmt->execute();
        header("Location: read.php");
        exit();
    } catch (PDOException $e) {
    }
}
?>