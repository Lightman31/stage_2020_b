
	<?php 
	// MAJ du sav a modifier
	include ("connect.php");
		$bdd = connectBDD();
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,UID) VALUES ( ?,?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['UID'])) ;

			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav4'].'"),NOW(),"En attente");'); 

			$req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav4'].'"),NOW(),"En attente");'); 

			$req = $bdd->query('INSERT INTO Ordre(sav,inf_dat_ordre,nom_ordre) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav4'].'"),NOW(),"En attente d\'ordre");'); 

		//echo '<meta http-equiv="refresh" content="0 ../index.php"> ';
	?>
