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
		echo 'UPDATE SAV SET note = CONCAT((SELECT note FROM (SELECT note FROM SAV) AS X WHERE num_sav = "', $_POST['num_sav6'],'"), " ',$_POST['commentaire'],'") WHERE num_sav = "',$_POST['num_sav6'],'";'; <br />
		echo 'SELECT num_sav,nom_sav,UID,emplacement,note FROM SAV WHERE num_sav = ',$_POST['num_sav6'],';'
	?>
	</p>

	<p>
		<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire
	</p>
</body>