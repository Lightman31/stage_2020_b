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
		$bdd = new PDO ('mysql:host=localhost;dbname=blet;charset=utf8','root','root');
		$req = $bdd->query('UPDATE SAV SET UID = '.$_POST['UID'].' WHERE num_sav = "'. $_POST['num_sav5'].'";'); 

		echo 'ligne modifiée<br />	';
		$lis = $bdd->query('SELECT * FROM SAV;');
		while ($donnees = $lis->fetch())
		{
			echo $donnees['num_sav'],' ',$donnees['UID'],' ',$donnees['emplacement'] , '<br />';
		}	
		
	?>
	</p>

	<p>
		<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire
	</p>
</body>
