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
		$req = $bdd->query(' UPDATE SAV SET deadline ="'.$_POST['ddline'].'" WHERE num_sav ="'.$_POST['num_sav3'].'"; '); 

		echo 'ligne modifiée avec succès<br />	';
		$lis = $bdd->query('SELECT * FROM SAV;');
		while ($donnees = $lis->fetch())
		{
			echo $donnees['num_sav'],' ',$donnees['UID'],' ',$donnees['emplacement'] , '<br />';
		}	
	?>
	</p>

	<p>
		<meta http-equiv="refresh" content="0 ../index.php"> pour revenir à la page home
	</p>
</body>