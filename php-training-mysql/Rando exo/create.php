<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=hiking_db;charset=utf8;port=3307', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et stop
        die('Erreur : '.$e->getMessage());
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
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
<?php
    //recup les infos du form 
    $name = isset($_POST['name']) ? $_POST['name'] :"add name";
    $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : "add difficulty";
    $distance = isset($_POST['distance']) ? $_POST['distance'] : "add distance";
	$duration = isset($_POST['duration']) ? $_POST['duration'] : "add duration";
	$height_difference = isset($_POST['height_difference']) ? $_POST['height_difference'] : "add height_difference";
    //echo $name;



// Ecriture de la requête

$insert = $bdd -> prepare('INSERT INTO hiking (name, difficulty, distance, duration,height_difference) 
VALUES (:name, :difficulty, :distance, :duration, :height_difference)');


// Exécution ! 
$insert->execute([
    'name' => $name,
    'difficulty' => $difficulty,
    'distance' => $distance,
	'duration' => $duration,
	'height_difference' => $height_difference,
    
]) or die();
header("Location: create.php");
?>