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
		if ($_POST['statut21'] == "")
		{
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,emplacement,UID) VALUES ( ?,"logistique",?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['UID'])) ;
		}
		else
		{
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,emplacement,UID) VALUES ( ?,?,?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['statut21'],$_POST['UID'])) ;
		}
		echo 'ligne ajoutée<br />	';
		$lis = $bdd->query('SELECT * FROM SAV ORDER BY num_sav;');
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
