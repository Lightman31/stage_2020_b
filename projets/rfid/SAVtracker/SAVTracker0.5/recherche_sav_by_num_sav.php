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
		$bdd = new PDO ('mysql:host=localhost;dbname=blet;charset=utf8','root','root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$req = $bdd->query('SELECT Statut.nom_statut, Statut.inf_dat, sav.num_sav, sav.deadline FROM sav, Statut WHERE sav.num_sav = "'.$_POST['num_sav1'].'" AND sav.id_sav = Statut.sav ORDER BY Statut.inf_dat;'); 
		while ($donnees = $req->fetch())
		{
			echo $donnees['nom_statut'],' ', $donnees['inf_dat'], '<br />';
		}
	?>
	</p>

	<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>
</body>

