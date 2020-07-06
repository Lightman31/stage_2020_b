


<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
		echo 'UPDATE SAV SET emplacement ="';
		echo $_POST['emplacement'];
		echo '" WHERE num_sav ="';
		echo $_POST['num_sav2'];
		echo '";';


	// creation du nouveau statut
		echo '<br/>';

		echo 'INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where num_sav = "';
		echo $_POST['num_sav2'];
		echo '"),NOW(),"';
		if ($_POST['statut12'] == "" && $_POST['statut11'] == "") // dans le cas ou l'utilisatuer ne saisit pas de nouveau statut, on écrit l'emplacement
		{
			echo $_POST['emplacement'];
		}
		else // dans le cas ou l'utilisateur saisit un nouveau statut, on écrit celui saisit
		{
			echo $_POST['statut11']; 
			if ($_POST['statut11'] != "" && $_POST['statut12'] != "") {echo ' ';}
			echo $_POST['statut12'];
		}
		echo '");';

	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>
