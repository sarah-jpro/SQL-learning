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
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
  
    <table>
      <!-- Afficher la liste des randonnées -->
      <thead>
            <tr>
                <th>name</th>
                <th>difficulty</th>
                <th>distance</th>
                <th>duration</th>
                <th>height_difference</th>
            </tr>
        </thead>
        <tbody>
          <tr>
          <?php
          $resultat = $bdd->query('SELECT * FROM hiking');

          while($row1 = $resultat ->fetch()){
            echo "<td>" . $row1['name'] . "</td>";
            echo "<td>" . $row1['difficulty'] . "</td>";
            echo "<td>" . $row1['distance'] . "</td>";
            echo "<td>" . $row1['duration'] . "</td>";
            echo "<td>" . $row1['height_difference'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
        </table>
    </table>
  </body>
</html>
