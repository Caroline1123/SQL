<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=hiking;charset=utf8', 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare('INSERT INTO hiking (name, difficulty, distance, duration, height_difference) 
	VALUES (:name, :difficulty, :distance, :duration, :height_difference)');
	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		if (isset($_POST["name"]) && isset($_POST["duration"]) && isset($_POST["distance"]) && isset($_POST["height_difference"])) {
			$stmt->bindValue(":name", $_POST["name"], PDO::PARAM_STR);
			$stmt->bindValue(":difficulty", $_POST["difficulty"], PDO::PARAM_STR);
			$stmt->bindValue(":distance", $_POST["distance"], PDO::PARAM_STR);
			$stmt->bindValue(":duration", $_POST["duration"], PDO::PARAM_STR);
			$stmt->bindValue(":height_difference", $_POST["height_difference"], PDO::PARAM_STR);
		}
		$stmt->execute();
		$message = "Data successfully added!";
	}
} catch (PDOException $e) {
	die('ERROR :' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
	<?php if (isset($message)) {
		echo "<h5>" . $message . '</h5>';
	} ?>
	<a href="read.php">Data List</a>
	<h1>Add </h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="" required>
		</div>
		<div>
			<label for="difficulty">Difficulty</label>
			<select name="difficulty">
				<option value="very easy">Very Easy</option>
				<option value="easy">Easy</option>
				<option value="average">Average</option>
				<option value="difficult">Difficult</option>
				<option value="very difficult">Very Difficult</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="" required>
		</div>
		<div>
			<label for="duration">Duration</label>
			<input type="time" name="duration" value="" required>
		</div>
		<div>
			<label for="height_difference">Height Difference</label>
			<input type="text" name="height_difference" value="" required>
		</div>
		<button type="submit" name="button">Send</button>
	</form>
</body>

</html>