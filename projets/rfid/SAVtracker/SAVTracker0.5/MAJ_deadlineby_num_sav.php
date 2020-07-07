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
		echo 'UPDATE SAV SET deadline =';
		echo $_POST['ddline'];
		echo ' WHERE num_sav ="';
		echo $_POST['num_sav3'];
		echo '";';
	?>
	</p>

	<p>
		<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire
	</p>
</body>