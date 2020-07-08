<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
	<title>SAV</title>
</head>
<body>
	<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
	include ("connect.php");
	$bdd = connectBDD();
	$reponse = $bdd->query('SELECT * FROM SAV ORDER BY deadline DESC;'); 

	echo '<table>';
	while ($donnees = $reponse->fetch())
	{
		echo '<tr><td>';
		echo $donnees['num_sav'].' : </td><td> '.$donnees['emplacement'].' </td><td> '.$donnees['deadline'] .' </td><td>      : '.$donnees['UID'] ;

		echo '</td></tr>';
	}	
	echo '</table>';


	?>
	</p>

	<p>
		<a href="../index.php">clique ici</a> pour revenir à la page du formulaire
	</p>
</body>