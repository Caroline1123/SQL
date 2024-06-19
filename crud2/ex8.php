<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE clientId = 24 OR ID = 25");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('DELETE FROM bookings WHERE clientId = 24 OR id = 25');
        $stmt->execute();
        $message = "<div class='alert alert-success' role='alert'>Bookings successfully deleted</div>";
    } catch (PDOException $e) {
        echo "" . $e->getMessage();
    }
}
?>



<?php require "partials/head.php" ?>
<?php if (isset($message)) {
    echo $message;
} ?>
<form action="" method="POST">
    <?php foreach ($results as $result): ?>
        <div class="border rounded w-50 p-3 mb-3">
            <p><b>Booking ID: </b> <?php echo $result["id"] ?></p>
            <p class="mb-0"><b>Customer ID: </b> <?php echo $result["clientId"] ?> </p>
        </div>
    <?php endforeach; ?>

    <button class="btn btn-primary" type="submit">Delete</button>
</form>



<?php require "partials/end.php" ?>