<?php
$pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE bookingsId = 24 OR bookingsId = 25');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('DELETE FROM tickets WHERE bookingsId = 24 OR bookingsId = 25');
        $stmt->execute();
        $message = "<div class='alert alert-success' role='alert'>Tickets successfully deleted</div>";
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

?>


<?php require "partials/head.php" ?>
<?php if (isset($message)) {
    echo $message;
} ?>
<h3> Delete Tickets</h3>
<form action="" method="POST">
    <?php foreach ($results as $result): ?>
        <div class="border rounded w-50 p-3 mb-3">
            <p class="mb-0"><b>Ticket Number: </b> <?php echo $result["id"] ?></p>
            <p class="mb-0"><b>Price: </b> <?php echo $result["price"] . " €" ?></p>
            <p class="mb-0"><b>Booking ID: </b> <?php echo $result["bookingsId"] ?></p>
        </div>
    <?php endforeach; ?>
    <button class="btn btn-primary" type="submit">Delete Tickets</button>
</form>
<?php require "partials/end.php" ?>