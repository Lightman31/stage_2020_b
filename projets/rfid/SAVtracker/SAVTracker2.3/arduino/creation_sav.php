<?php

	include ("../back/connect.php");
	$bdd = connectBDD();




	$req = $bdd->query ('SELECT * FROM SAV where UID = "'.$_GET['UID'].'"; ');

	$res = $req->fetch();
	if ($res['num_sav'])
	{
		$req = $bdd->query ('UPDATE SAV SET UID = NULL WHERE UID = '.$_GET['UID'].';');
	}


	$req = $bdd->query ('SELECT * FROM SAV where num_sav = "'.$_GET['S'].'"; ');

	$res = $req->fetch();
	if ($res['num_sav'])
	{
		$req = $bdd->query ('INSERT INTO SAV (num_sav, UID) VALUES ("'.$_GET['S'].'",'.$_GET['UID'].');');
	}	
	else 
	{
		$req = $bdd->query ('UPDATE SAV SET UID = '.$_GET['UID'].' WHERE num_sav = "'.$_GET['S'].'";');
	}

	$req = $bdd->query('INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_GET['S'].'"),NOW(),"Juste arrive");'); 

	$req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_GET['S'].'"),NOW(),"Logistique");'); 

	$req = $bdd->query('INSERT INTO Ordre(sav,inf_dat_ordre,nom_ordre) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_GET['S'].'"),NOW(),"Expertise niveau 1");'); 




?>
