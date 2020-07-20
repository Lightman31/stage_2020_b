<?php

	include ("../back/connect.php");
	$bdd = connectBDD();


	echo 'B = '.$_GET['B'].'</br>S = '.$_GET['S'].'</br>UID = '.$_GET['UID'].'</br></br>';

	$req = $bdd->query ('SELECT * FROM SAV where UID = "'.$_GET['UID'].'"; ');


	//echo 'SELECT * FROM SAV where UID = "'.$_GET['UID'].'";</br>'.$req->rowCount().'</br>';

	if ($req->rowCount() != 0) // dans le cas ou cette carte est déja attribué, on la désatribue du SAV précédent
	{
		$req = $bdd->query ('UPDATE SAV SET UID = NULL WHERE UID = '.$_GET['UID'].';');
	}


	$req = $bdd->query ('SELECT * FROM SAV where num_sav = "'.$_GET['S'].'"; ');

	//echo 'SELECT * FROM SAV where num_sav = "'.$_GET['S'].'";</br>'.$req->rowCount().'</br>';
	if ($req->rowCount() == 0) // Dans le cas ou il n'y a pas de SAV déja existant, on en crée un nouveau, si non, on mets a jour celui qui existe déja
	{
		$req = $bdd->query ('INSERT INTO SAV (num_sav, UID) VALUES ("'.$_GET['S'].'",'.$_GET['UID'].');');
		//echo 'INSERT INTO SAV (num_sav, UID) VALUES ("'.$_GET['S'].'",'.$_GET['UID'].');';
	}	
	else 
	{
		$req = $bdd->query ('UPDATE SAV SET UID = '.$_GET['UID'].' WHERE num_sav = "'.$_GET['S'].'";');
		//echo '</br></br>UPDATE SAV SET UID = '.$_GET['UID'].' WHERE num_sav = "'.$_GET['S'].'";';
	}

	$req = $bdd->query('INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_GET['S'].'"),NOW(),"Arrivée Client");'); 

	$req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_GET['S'].'"),NOW(),"Logistique Entrée");'); 




?>
