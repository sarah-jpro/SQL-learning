<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8;port=3307', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
$resultat = $bdd->query('SELECT * FROM météo');


while ($donnees = $resultat->fetch())
{
//echo "<pre>";
//print_r ($donnees);
//echo "</pre>";
}
$resultat->closeCursor();

?>
<form action="" method="get">
        <label for="ville">Entrez une ville</label>
        <input type="" name="ville"> <br>
        <label for="haut">Entrez une température max</label>
        <input type="" name="haut"> <br>
        <label for="bas">Entrez une température min</label>
        <input type="" name="bas"> <br>
        <input type="checkbox" id="zone" name="ville" value="Bruxelles">
        <label for="ville">Bruxelles</label><br>
        <input type="checkbox" id="zone" name="ville" value="Liège">
        <label for="ville">Liège</label><br>
        <input type="checkbox" id="zone" name="ville" value="Namur">
        <label for="ville">Namur</label><br>
        <input type="checkbox" id="zone" name="ville" value="Charleroi">
        <label for="ville">Charleroi</label><br>
        <input type="checkbox" id="zone" name="ville" value="Bruges">
        <label for="ville">Bruges</label><br>
        <input type="submit">
    </form>

    <?php
    //recup les infos du form 
    $ville = isset($_GET['ville']) ? $_GET['ville'] : NULL;
    $haut = isset($_GET['haut']) ? $_GET['haut'] : NULL;
    $bas = isset($_GET['bas']) ? $_GET['bas'] : NULL;
    echo $ville;
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8;port=3307', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


// Ecriture de la requête
$insertmétéo= $bdd -> prepare('INSERT INTO météo(ville, haut, bas) 
VALUES (:ville, :haut, :bas)');

// Exécution ! 
$insertmétéo->execute([
    'ville' => $ville,
    'haut' => $haut,
    'bas' => $bas,
    
]);


$resultat -> closeCursor();

?>
