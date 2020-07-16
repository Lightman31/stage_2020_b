<?php

	include ("../back/connect.php");
	$bdd = connectBDD();
			

	$req = $bdd->query ('SELECT * FROM SAV where UID = "'.$_GET['UID'].'"; ');

	$res = $req->fetch();
	if ($res['num_sav'] != "")
	{
		$req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES((SELECT SAV.id_sav FROM SAV where SAV.UID = '.$_GET['UID'].'),NOW(),"Labo_1");'); 

		echo 	'SUCCES'; 
	}
	else 
	{
echo 'ECHEC';
	}





?>
