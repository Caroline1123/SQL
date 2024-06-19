<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM Clients WHERE id = 5;');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
} catch (PDOException $e) {
    $message = $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["last_name"]) && isset($_POST["first_name"]) && isset($_POST["birthday"])) {
        // Check if cardnr is filled out when card checkbox is ticked
        $isCardChecked = isset($_POST['card']);
        $isCardNumberProvided = !empty($_POST['card_number']);
        if (($isCardChecked && $isCardNumberProvided) || (!$isCardChecked && !$isCardNumberProvided)) {
            $message = "<div class='alert alert-success' role='alert'> form submission received </div>";
            try {
                $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
                $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
                $birthday = filter_var($_POST["birthday"], FILTER_SANITIZE_STRING);
                $card = $isCardChecked;
                // Sets card nr to NULL if filed not filled out
                $card_number = !empty($_POST['card_number']) ? filter_var($_POST['card_number'], FILTER_SANITIZE_NUMBER_INT) : NULL;

                $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare('UPDATE Clients SET lastName=:last_name, firstName=:first_name, birthDate=:birthday , card=:card, cardNumber=:card_number WHERE id = 5');
                $stmt->bindParam('last_name', $last_name);
                $stmt->bindParam('first_name', $first_name);
                $stmt->bindParam('birthday', $birthday);
                $stmt->bindParam('card', $card, PDO::PARAM_INT);
                if ($card_number === NULL) {
                    $stmt->bindValue(':card_number', NULL, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':card_number', $card_number, PDO::PARAM_INT);
                }
                $stmt->execute();
                $message = "<div class='alert alert-success' role='alert'> Information successfully updated </div>";
            } catch (PDOException $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = "<div class='alert alert-warning' role='alert'>Card Information Invalid</div>";
        }
    } else {
        $message = "<div class='alert alert-warning' role='alert'>Some information was missing</div>";
    }
}
?>


<?php require "partials/head.php" ?>
<?php if (isset($message)) {
    echo $message;
} ?>
<h3>Register</h3>
<form class="border rounded p-3" action="" method="POST">
    <h6>Your Details</h6>
    <label for="first_name">First Name :</label>
    <input class="form-control my-2 w-50" type="text" name="first_name" value="<?php echo $results['firstName'] ?>"
        required>

    <label for="last_name">Last Name :</label>
    <input class="form-control my-2 w-50" type="text" name="last_name" value="<?php echo $results['lastName'] ?>"
        required>

    <label for="birthday">Birth Date : </label>
    <input class="form-control my-2 w-50" type="date" name="birthday" value="<?php echo $results['birthDate'] ?>"
        required>

    <h6>Card Information</h6>
    <input class="mt-2" type="checkbox" name="card" <?php echo ($results['card'] == 0) ? "" : "checked"; ?>>
    <label class="ps-2 pb-1" for="card">I own a card </label>
    <br> <label for="card_number">Card Number : </label>
    <input class="form-control my-2 w-25" type="number" name="card_number" value="<?php echo $results['cardNumber'] ?>">


    <button class="d-flex mt-4 btn btn-primary" type="submit">Update</button>

</form>

<?php require "partials/end.php" ?>