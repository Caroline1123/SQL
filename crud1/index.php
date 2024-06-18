<?php
$pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ex1: Get all clients
try {
    $stmt = $pdo->prepare('SELECT * FROM Clients;');
    $stmt->execute();
    $clients_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR:' . $e->getMessage();
}

// ex2: Get all spectacle types
try {
    $stmt = $pdo->prepare('SELECT * FROM showtypes;');
    $stmt->execute();
    $spectacle_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR:' . $e->getMessage();
}

// ex3: get 20 first clients entries
try {
    $stmt = $pdo->prepare('SELECT * FROM Clients LIMIT 20;');
    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR:' . $e->getMessage();
}
// ex4: get clients names who have cards
try {
    $stmt = $pdo->prepare('SELECT * FROM Clients WHERE card = 1;');
    $stmt->execute();
    $clients_cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR:' . $e->getMessage();
}

// ex5: get clients which have name starting with M
try {
    $stmt = $pdo->prepare('SELECT * FROM Clients WHERE lastName LIKE "m%" ORDER BY lastName ASC;');
    $stmt->execute();
    $mlients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR:' . $e->getMessage();
}
// ex6: Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. 
// Trier les titres par ordre alphabétique.
// Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.
try {
    $stmt = $pdo->prepare('SELECT * FROM Shows ORDER BY title;');
    $stmt->execute();
    $spectacles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERROR:' . $e->getMessage();
}



?>

<?php require "partials/head.php" ?>
<h3>Exercise 1</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Last Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Card</th>
            <th scope="col">Card Number</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients_results as $row): ?>
            <tr>
                <th class="py-0" scope="row"><?php echo $row["id"] ?></th>
                <td class="py-0"><?php echo $row["lastName"] ?></td>
                <td class="py-0"><?php echo $row["firstName"] ?></td>
                <td class="py-0"><?php echo $row["birthDate"] ?></td>
                <td class="py-0"><?php echo $row["card"] ?></td>
                <td class="py-0"><?php echo $row["cardNumber"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h3>Exercise 2</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Type</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($spectacle_types as $row): ?>
            <tr>
                <th class="py-0" scope="row"><?php echo $row["id"] ?></th>
                <td class="py-0"><?php echo $row["type"] ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Exercise 3</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Last Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Card</th>
            <th scope="col">Card Number</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $row): ?>
            <tr>
                <th class="py-0" scope="row"><?php echo $row["id"] ?></th>
                <td class="py-0"><?php echo $row["lastName"] ?></td>
                <td class="py-0"><?php echo $row["firstName"] ?></td>
                <td class="py-0"><?php echo $row["birthDate"] ?></td>
                <td class="py-0"><?php echo $row["card"] ?></td>
                <td class="py-0"><?php echo $row["cardNumber"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Exercise 4</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Last Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Card</th>
            <th scope="col">Card Number</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients_cards as $row): ?>
            <tr>
                <th class="py-0" scope="row"><?php echo $row["id"] ?></th>
                <td class="py-0"><?php echo $row["lastName"] ?></td>
                <td class="py-0"><?php echo $row["firstName"] ?></td>
                <td class="py-0"><?php echo $row["birthDate"] ?></td>
                <td class="py-0"><?php echo $row["card"] ?></td>
                <td class="py-0"><?php echo $row["cardNumber"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h3>Exercise 5</h3>
<?php foreach ($mlients as $row): ?>
    <ul class="my-2">
        <li class="">First Name : <?php echo $row["firstName"] ?></li>
        <li class="">Last Name : <?php echo $row["lastName"] ?></li>
    </ul>
<?php endforeach; ?>

<h3>Exercise 6</h3>
<?php foreach ($spectacles as $row): ?>
    <?php echo '
    <p>
        <i>' . $row["title"] . '</i> by <b>' . $row['performer'] . '</b> on ' . $row['date'] . ' at ' . $row['startTime'] . '
    </p>
    
    '; ?>

<?php endforeach; ?>


<h3>Exercise 7</h3>
<?php foreach ($clients as $row): ?>
    <div class="my-2 d-flex flex-column border rounded p-2">
        <p class="mb-0"><b>Last Name : </b><?php echo $row["lastName"] ?></p>
        <p class="mb-0"><b>First Name : </b><?php echo $row["firstName"] ?></p>
        <p class="mb-0"><b>Birthday : </b> <?php echo $row["birthDate"] ?></p>
        <p class="mb-0"><b>Card : </b> <?php echo ($row["card"] == 1) ? "Yes" : "No" ?></p>
        <?php
        if ($row["card"] == 1) {
            echo "<p class='mb-0'><b>Numéro de carte : </b>" . $row["cardNumber"] . "</p>";
        }
        ?>
    </div>
<?php endforeach; ?>




<?php require "partials/end.php" ?>