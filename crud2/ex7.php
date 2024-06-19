<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM Clients WHERE ID = 24 OR ID = 25');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo print_r($results);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('DELETE FROM Clients WHERE ID = 24 OR ID = 25');
        $stmt->execute();
        $message = "<div class='alert alert-success' role='alert'>Records successfully deleted</div>";

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>


<!-- HTML -->

<?php require "partials/head.php" ?>
<?php if (isset($message)) {
    echo $message;
} ?>
<h3>Delete</h3>
<form class="border rounded p-3" action="" method="POST">
    <?php foreach ($results as $result): ?>
        <label for="first_name">First Name :</label>
        <input class="form-control my-2 w-50" type="text" name="first_name" value="<?php echo $result['firstName'] ?>"
            required>

        <label for="last_name">Last Name :</label>
        <input class="form-control my-2 w-50" type="text" name="last_name" value="<?php echo $result['lastName'] ?>"
            required>

        <label for="birthday">Birth Date : </label>
        <input class="form-control my-2 w-50" type="date" name="birthday" value="<?php echo $result['birthDate'] ?>"
            required>

        <h6>Card Information</h6>
        <input class="mt-2" type="checkbox" name="card" <?php echo ($result['card'] == 0) ? "" : "checked"; ?>>
        <label class="ps-2 pb-1" for="card">I own a card </label>
        <br> <label for="card_number">Card Number : </label>
        <input class="form-control my-2 w-25" type="number" name="card_number" value="<?php echo $result['cardNumber'] ?>">
        <hr>
    <?php endforeach; ?>

    <button class="d-flex mt-4 btn btn-primary" type="submit">Delete</button>

</form>


<?php require "partials/end.php" ?>