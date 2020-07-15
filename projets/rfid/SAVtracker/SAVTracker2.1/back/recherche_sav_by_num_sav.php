<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/tuto.css" rel="stylesheet">
	<title>SAV</title>
</head>
<body>
	<p>

	<?php 
	// MAJ du sav a modifier
	include ("connect.php");
		$bdd = connectBDD();
		
		$req = $bdd->query('SELECT * FROM SAV WHERE SAV.num_sav = "'.$_POST['num_sav1'].'"'); 
		//echo 'SELECT SAV.num_sav, SAV.deadline, SAV.UID, SAV.emplacement, SAV.note FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat;';
		
		echo '<h1>INFO SAV</h1>';
		if ($donnees = $req->fetch())
		{
			echo '<table>';
			echo '<tr><td>numero de SAV : </td><td>'.$donnees['num_sav'].'</tr></td><tr><td>UID : </td><td>'.$donnees['UID'];
			echo '</table>';
		}
		else
		{
			echo 'Ce numero de SAV nest pas attribue';
		}




		$req = $bdd->query('SELECT * FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat_statut DESC;'); 

		echo '<h1>historique des statut</h1>';
		echo '<table>';
		while ($donnees = $req->fetch())
		{
			echo '<tr><td>';
			echo $donnees['inf_dat_statut'].' : </td><td>'. $donnees['nom_statut'];
			echo '</td></tr>';
		}
		echo '</table>';
	?>
	</p>

	<p>
	<a href="../index.php">clique ici</a> pour revenir à la page du formulaire</p>
</body>

