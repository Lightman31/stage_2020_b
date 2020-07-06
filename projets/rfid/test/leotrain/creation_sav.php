<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
		echo 'INSERT INTO SAV(num_sav,emplacement,UID) VALUES (';
		echo $_POST['num_sav4'];
		if ($_POST['statut12'] == "") {echo ",logistique";}
		else {echo ',',$_POST['statut12'];}
		echo ',',$_POST['UID'];
		echo ');';
	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>