<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8;port=3307', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et stop
        die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>weatherapp</title>
</head>
<body>
    <h1>weatherapp</h1>
    <h2>Tableau HTML</h2>

    <?php
    $resultat = $bdd->query('SELECT * FROM météo');
    ?>

<!--Création du tableau-->
<form action="" method="post">
        <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Ville</th>
                <th>Température maximale</th>
                <th>Température minimale</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $resultat->fetch()) : ?>
            <tr>
                <td><input type="checkbox" name="del[]" value=<?php echo $row['ville'];?> </td>
                <td><?php echo ($row['ville']); ?></td>
                <td><?php echo ($row['haut']); ?></td>
                <td><?php echo ($row['bas']); ?></td>
            </tr>

            <?php endwhile; 
            $resultat->closeCursor();
            ?>
        </tbody>
        </table>

        <?php
        if(isset($_POST['del'])) {
            foreach($_POST['del'] as $value) {
                $deleteRes = $bdd -> prepare("DELETE FROM météo WHERE ville = :ville");
                $deleteRes -> execute([
                    'ville' => $value,
                ]);
            }
        }
        ?>

        <input type="submit" value="Supprimer une ville?" class="btn1">
    </form>

    <form action="" method="post">
        <label for="ville">Ville</label>
        <input type="" name="ville" pl> <br>
        <label for="haut">Température max</label>
        <input type="" name="haut"> <br>
        <label for="bas">Température min</label>
        <input type="" name="bas"> <br>
        <input type="submit" value="Ajout ville" class="btn2">
    </form>


 

<?php
    //recup les infos du form 
    $ville = isset($_POST['ville']) ? $_POST['ville'] :"ville requise";
    $haut = isset($_POST['haut']) ? $_POST['haut'] : "Température max requise";
    $bas = isset($_POST['bas']) ? $_POST['bas'] : "Température min requise";
    //echo $ville;



// Ecriture de la requête
$insertmétéo= $bdd -> prepare('INSERT INTO météo(ville, haut, bas) 
VALUES (:ville, :haut, :bas)');

// Exécution ! 
$insertmétéo->execute([
    'ville' => $ville,
    'haut' => $haut,
    'bas' => $bas,
    
]) or die();

$resultat -> closeCursor();
?>
