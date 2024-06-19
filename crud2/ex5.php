<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM Shows WHERE id = 1');
    $stmt->execute();
    $results = $stmt->fetchAll((PDO::FETCH_ASSOC));
    $results = $results[0];
} catch (PDOException $e) {
    echo '' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['title']) && isset($_POST['performer']) && isset($_POST['date'])
        && $_POST['show_type'] != "" && $_POST['genre1'] != "" && $_POST['genre2'] != "" && isset($_POST['duration']) && isset($_POST['start-time'])
    ) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("UPDATE shows SET title=:title, performer=:performer, date=:date, showTypesId=:show_type, firstGenresId=:genre1, secondGenreId=:genre2, duration=:duration, startTime=:start_time
        WHERE id = 1");
            $stmt->bindParam(":title", $_POST["title"], PDO::PARAM_STR);
            $stmt->bindParam(":performer", $_POST["performer"], PDO::PARAM_STR);
            $stmt->bindParam(":date", $_POST["date"]);
            $stmt->bindParam(":show_type", $_POST["show_type"], PDO::PARAM_INT);
            $stmt->bindParam(":genre1", $_POST["genre1"], PDO::PARAM_INT);
            $stmt->bindParam(":genre2", $_POST["genre2"], PDO::PARAM_INT);
            $stmt->bindParam(":duration", $_POST["duration"]);
            $stmt->bindParam(":start_time", $_POST["start-time"]);
            $stmt->execute();
            $message = "<div class='alert alert-success' role='alert'>Event successfully updated !</div>";
        } catch (PDOException $e) {
            echo '' . $e->getMessage();
        }
    } else {
        $message = "<div class='alert alert-warning' role='alert'>Some information was missing</div>";
    }
}


?>



<!-- HTML -->

<?php require "partials/head.php" ?>
<?php if (isset($message)) {
    echo $message;
}
?>

<h3>Update Spectacle</h3>
<form class="border rounded p-3" action="" method="POST">
    <label for="title">Title :</label>
    <input class="form-control my-2 w-50" type="text" name="title" value="<?php echo $results['title'] ?>" required>

    <label for="performer">Performer :</label>
    <input class="form-control my-2 w-50" type="text" name="performer" value="<?php echo $results['performer'] ?>"
        required>

    <label for="date">Date : </label>
    <input class="form-control my-2 w-50" type="date" name="date" value="<?php echo $results['date'] ?>" required>

    <label for="show_type">Show Type : </label>
    <select class="form-select w-50 my-2" name="show_type">
        <option value="" selected>Select an option
        </option>
        <option value="1" <?php if ($results["showTypesId"] == 1)
            echo 'selected'; ?>>Concert</option>
        <option value="2" <?php if ($results["showTypesId"] == 2)
            echo 'selected'; ?>>Theatre</option>
        <option value="3" <?php if ($results["showTypesId"] == 3)
            echo 'selected'; ?>>Humour</option>
        <option value="4" <?php if ($results["showTypesId"] == 4)
            echo 'selected'; ?>>Dance</option>
    </select>

    <label for="genre1">Show genre : </label>
    <select class="my-2 form-select w-50" name="genre1">
        <option value="">Select an option</option>
        <option value="1" <?php if ($results["firstGenresId"] == 1)
            echo 'selected'; ?>>French Variety</option>
        <option value="2" <?php if ($results["firstGenresId"] == 2)
            echo 'selected'; ?>>International Variety</option>
        <option value="3" <?php if ($results["firstGenresId"] == 3)
            echo 'selected'; ?>>Pop/Rock</option>
        <option value="4" <?php if ($results["firstGenresId"] == 4)
            echo 'selected'; ?>>Electronic</option>
        <option value="5" <?php if ($results["firstGenresId"] == 5)
            echo 'selected'; ?>>Folk</option>
        <option value="6" <?php if ($results["firstGenresId"] == 6)
            echo 'selected'; ?>>Rap</option>
        <option value="7" <?php if ($results["firstGenresId"] == 7)
            echo 'selected'; ?>>HipHop</option>
        <option value="8" <?php if ($results["firstGenresId"] == 8)
            echo 'selected'; ?>>Slam</option>
        <option value="9" <?php if ($results["firstGenresId"] == 9)
            echo 'selected'; ?>>Reggae</option>
        <option value="10" <?php if ($results["firstGenresId"] == 10)
            echo 'selected'; ?>>Clubbing</option>
        <option value="11" <?php if ($results["firstGenresId"] == 11)
            echo 'selected'; ?>>RnB</option>
        <option value="12" <?php if ($results["firstGenresId"] == 12)
            echo 'selected'; ?>>Soul</option>
        <option value="13" <?php if ($results["firstGenresId"] == 13)
            echo 'selected'; ?>>Funk</option>
        <option value="14" <?php if ($results["firstGenresId"] == 14)
            echo 'selected'; ?>>Jazz</option>
        <option value="15" <?php if ($results["firstGenresId"] == 15)
            echo 'selected'; ?>>Blues</option>
        <option value="16" <?php if ($results["firstGenresId"] == 16)
            echo 'selected'; ?>>Country</option>
        <option value="17" <?php if ($results["firstGenresId"] == 17)
            echo 'selected'; ?>>Gospel</option>
        <option value="18" <?php if ($results["firstGenresId"] == 18)
            echo 'selected'; ?>>World Music</option>
        <option value="19" <?php if ($results["firstGenresId"] == 19)
            echo 'selected'; ?>>Classical</option>
        <option value="20" <?php if ($results["firstGenresId"] == 20)
            echo 'selected'; ?>>Opera</option>
        <option value="21" <?php if ($results["firstGenresId"] == 21)
            echo 'selected'; ?>>Others</option>
        <option value="22" <?php if ($results["firstGenresId"] == 22)
            echo 'selected'; ?>>Drama</option>
        <option value="23" <?php if ($results["firstGenresId"] == 23)
            echo 'selected'; ?>>Comedy</option>
        <option value="24" <?php if ($results["firstGenresId"] == 24)
            echo 'selected'; ?>>Contemporary</option>
        <option value="25" <?php if ($results["firstGenresId"] == 25)
            echo 'selected'; ?>>Monologue</option>
        <option value="26" <?php if ($results["firstGenresId"] == 26)
            echo 'selected'; ?>>One Man / Woman Show</option>
        <option value="27" <?php if ($results["firstGenresId"] == 27)
            echo 'selected'; ?>>Café-Théâtre</option>
        <option value="28" <?php if ($results["firstGenresId"] == 28)
            echo 'selected'; ?>>Stand Up</option>
        <option value="29" <?php if ($results["firstGenresId"] == 29)
            echo 'selected'; ?>>Others</option>
        <option value="30" <?php if ($results["firstGenresId"] == 30)
            echo 'selected'; ?>>Contemporary</option>
        <option value="31" <?php if ($results["firstGenresId"] == 31)
            echo 'selected'; ?>>Classical</option>
        <option value="32" <?php if ($results["firstGenresId"] == 32)
            echo 'selected'; ?>>Urban</option>
    </select>

    <label for="genre2">Secondary genre : </label>
    <select class="form-select w-50 my-2" name="genre2">
        <option value="">Select an option</option>
        <option value="1" <?php if ($results["secondGenreId"] == 1)
            echo 'selected'; ?>>French Variety</option>
        <option value="2" <?php if ($results["secondGenreId"] == 2)
            echo 'selected'; ?>>International Variety</option>
        <option value="3" <?php if ($results["secondGenreId"] == 3)
            echo 'selected'; ?>>Pop/Rock</option>
        <option value="4" <?php if ($results["secondGenreId"] == 4)
            echo 'selected'; ?>>Electronic</option>
        <option value="5" <?php if ($results["secondGenreId"] == 5)
            echo 'selected'; ?>>Folk</option>
        <option value="6" <?php if ($results["secondGenreId"] == 6)
            echo 'selected'; ?>>Rap</option>
        <option value="7" <?php if ($results["secondGenreId"] == 7)
            echo 'selected'; ?>>HipHop</option>
        <option value="8" <?php if ($results["secondGenreId"] == 8)
            echo 'selected'; ?>>Slam</option>
        <option value="9" <?php if ($results["secondGenreId"] == 9)
            echo 'selected'; ?>>Reggae</option>
        <option value="10" <?php if ($results["secondGenreId"] == 10)
            echo 'selected'; ?>>Clubbing</option>
        <option value="11" <?php if ($results["secondGenreId"] == 11)
            echo 'selected'; ?>>RnB</option>
        <option value="12" <?php if ($results["secondGenreId"] == 12)
            echo 'selected'; ?>>Soul</option>
        <option value="13" <?php if ($results["secondGenreId"] == 13)
            echo 'selected'; ?>>Funk</option>
        <option value="14" <?php if ($results["secondGenreId"] == 14)
            echo 'selected'; ?>>Jazz</option>
        <option value="15" <?php if ($results["secondGenreId"] == 15)
            echo 'selected'; ?>>Blues</option>
        <option value="16" <?php if ($results["secondGenreId"] == 16)
            echo 'selected'; ?>>Country</option>
        <option value="17" <?php if ($results["secondGenreId"] == 17)
            echo 'selected'; ?>>Gospel</option>
        <option value="18" <?php if ($results["secondGenreId"] == 18)
            echo 'selected'; ?>>World Music</option>
        <option value="19" <?php if ($results["secondGenreId"] == 19)
            echo 'selected'; ?>>Classical</option>
        <option value="20" <?php if ($results["secondGenreId"] == 20)
            echo 'selected'; ?>>Opera</option>
        <option value="21" <?php if ($results["secondGenreId"] == 21)
            echo 'selected'; ?>>Others</option>
        <option value="22" <?php if ($results["secondGenreId"] == 22)
            echo 'selected'; ?>>Drama</option>
        <option value="23" <?php if ($results["secondGenreId"] == 23)
            echo 'selected'; ?>>Comedy</option>
        <option value="24" <?php if ($results["secondGenreId"] == 24)
            echo 'selected'; ?>>Contemporary</option>
        <option value="25" <?php if ($results["secondGenreId"] == 25)
            echo 'selected'; ?>>Monologue</option>
        <option value="26" <?php if ($results["secondGenreId"] == 26)
            echo 'selected'; ?>>One Man / Woman Show</option>
        <option value="27" <?php if ($results["secondGenreId"] == 27)
            echo 'selected'; ?>>Café-Théâtre</option>
        <option value="28" <?php if ($results["secondGenreId"] == 28)
            echo 'selected'; ?>>Stand Up</option>
        <option value="29" <?php if ($results["secondGenreId"] == 29)
            echo 'selected'; ?>>Others</option>
        <option value="30" <?php if ($results["secondGenreId"] == 30)
            echo 'selected'; ?>>Contemporary</option>
        <option value="31" <?php if ($results["secondGenreId"] == 31)
            echo 'selected'; ?>>Classical</option>
        <option value="32" <?php if ($results["secondGenreId"] == 32)
            echo 'selected'; ?>>Urban</option>
    </select>

    <label for="duration">Duration :</label>
    <input class="form-control my-2 w-25" type="time" name="duration" value="<?php echo $results['duration'] ?>"
        required>

    <label for="start-time">Start Time :</label>
    <input class="form-control my-2 w-25" type="time" name="start-time" value="<?php echo $results['startTime'] ?>"
        required>

    <button class="d-flex mt-4 btn btn-primary" type="submit">Update</button>

</form>

<?php require "partials/end.php" ?>