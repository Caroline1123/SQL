<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Checks if all fields were correctly filled out
    if (
        isset($_POST['title']) && isset($_POST['performer']) && isset($_POST['date'])
        && $_POST['show_type'] != "" && $_POST['genre1'] != "" && $_POST['genre2'] != "" && isset($_POST['duration']) && isset($_POST['start-time'])
    ) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("INSERT INTO shows (title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime)
            VALUES (:title, :performer, :date, :show_type, :genre1, :genre2, :duration, :start_time);");
            $stmt->bindParam(":title", $_POST["title"], PDO::PARAM_STR);
            $stmt->bindParam(":performer", $_POST["performer"], PDO::PARAM_STR);
            $stmt->bindParam(":date", $_POST["date"]);
            $stmt->bindParam(":show_type", $_POST["show_type"], PDO::PARAM_INT);
            $stmt->bindParam(":genre1", $_POST["genre1"], PDO::PARAM_INT);
            $stmt->bindParam(":genre2", $_POST["genre2"], PDO::PARAM_INT);
            $stmt->bindParam(":duration", $_POST["duration"]);
            $stmt->bindParam(":start_time", $_POST["start-time"]);
            $stmt->execute();
            $message = "<div class='alert alert-success' role='alert'>Event successfully added !</div>";
        } catch (PDOException $e) {
            // $message = "<div class='alert alert-danger' role='alert'>Event could not be added.</div>";
            $message = $e->getMessage();
        }
    } else {
        $message = "<div class='alert alert-warning' role='alert'>Please fill out all fields. </div>";
    }
}
?>


<?php require "partials/head.php" ?>
<?php if (isset($message)) {
    echo $message;
} ?>
<h3>Add Spectacle</h3>
<form class="border rounded p-3" action="" method="POST">
    <label for="title">Title :</label>
    <input class="form-control my-2 w-50" type="text" name="title" id="title" required placeholder="Spectacle title">

    <label for="performer">Performer :</label>
    <input class="form-control my-2 w-50" type="text" name="performer" id="performer" required placeholder="Performer">

    <label for="date">Date : </label>
    <input class="form-control my-2 w-50" type="date" name="date" id="date" required>

    <label for="show_type">Show Type : </label>
    <select class="form-select w-50 my-2" name="show_type">
        <option value="" selected>Select an option
        </option>
        <option value="1">Concert</option>
        <option value="2">Theatre</option>
        <option value="3">Humour</option>
        <option value="4">Dance</option>
    </select>

    <label for="genre1">Show genre : </label>
    <select class="my-2 form-select w-50" name="genre1">
        <option value="" selected>Select an option
        </option>
        <option value="1">French Variety</option>
        <option value="2">International Variety</option>
        <option value="3">Pop/Rock</option>
        <option value="4">Electronic</option>
        <option value="5">Folk</option>
        <option value="6">Rap</option>
        <option value="7">HipHop</option>
        <option value="8">Slam</option>
        <option value="9">Reggae</option>
        <option value="10">Clubbing</option>
        <option value="11">RnB</option>
        <option value="12">Soul</option>
        <option value="13">Funk</option>
        <option value="14">Jazz</option>
        <option value="15">Blues</option>
        <option value="16">Country</option>
        <option value="17">Gospel</option>
        <option value="18">World Music</option>
        <option value="19">Classical</option>
        <option value="20">Opera</option>
        <option value="21">Others</option>
        <option value="22">Drama</option>
        <option value="23">Comedy</option>
        <option value="24">Contemporary</option>
        <option value="25">Monologue</option>
        <option value="26">One Man / Woman Show</option>
        <option value="27">Café-Théâtre</option>
        <option value="28">Stand Up</option>
        <option value="29">Others</option>
        <option value="30">Contemporary</option>
        <option value="31">Classical</option>
        <option value="32">Urban</option>
    </select>

    <label for="genre2">Secondary genre : </label>
    <select class="form-select w-50 my-2" name="genre2">
        <option value="" selected>Select an option
        </option>
        <option value="1">French Variety</option>
        <option value="2">International Variety</option>
        <option value="3">Pop/Rock</option>
        <option value="4">Electronic</option>
        <option value="5">Folk</option>
        <option value="6">Rap</option>
        <option value="7">HipHop</option>
        <option value="8">Slam</option>
        <option value="9">Reggae</option>
        <option value="10">Clubbing</option>
        <option value="11">RnB</option>
        <option value="12">Soul</option>
        <option value="13">Funk</option>
        <option value="14">Jazz</option>
        <option value="15">Blues</option>
        <option value="16">Country</option>
        <option value="17">Gospel</option>
        <option value="18">World Music</option>
        <option value="19">Classical</option>
        <option value="20">Opera</option>
        <option value="21">Others</option>
        <option value="22">Drama</option>
        <option value="23">Comedy</option>
        <option value="24">Contemporary</option>
        <option value="25">Monologue</option>
        <option value="26">One Man / Woman Show</option>
        <option value="27">Café-Théâtre</option>
        <option value="28">Stand Up</option>
        <option value="29">Others</option>
        <option value="30">Contemporary</option>
        <option value="31">Classical</option>
        <option value="32">Urban</option>
    </select>

    <label for="duration">Duration :</label>
    <input class="form-control my-2 w-25" type="time" name="duration" value="" required>

    <label for="start-time">Start Time :</label>
    <input class="form-control my-2 w-25" type="time" name="start-time" value="" required>

    <button class="d-flex mt-4 btn btn-primary" type="submit">Register</button>

</form>

<?php require "partials/end.php" ?>