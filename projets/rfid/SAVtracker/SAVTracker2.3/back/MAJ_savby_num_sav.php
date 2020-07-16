


<p>
	requete :<br/> 
	<?php 


	include ("connect.php");
		$bdd = connectBDD();

	// MAJ du sav a modifier
		$req = $bdd->query('UPDATE SAV SET emplacement ="'. $_POST['emplacement'] .'" WHERE num_sav ="'.$_POST['num_sav2'].'";'); 

	// creation du nouveau statut

		if ($_POST['statut12'] == "" && $_POST['statut11'] == "") // dans le cas ou l'utilisatuer ne saisit pas de nouveau statut, on écrit l'emplacement
		{
			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav2'].'"),NOW(),"'.$_POST['emplacement'].'");'); 
		}
		else // dans le cas ou l'utilisateur saisit un nouveau statut, on écrit celui saisit
		{
			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav2'].'"),NOW(),"'.$_POST['statut11'].$_POST['statut12'].'");'); 
		}

	?>
</p>

<p>
	<a href="../home.php">clique ici</a> pour revenir à la page du formulaire</p>
