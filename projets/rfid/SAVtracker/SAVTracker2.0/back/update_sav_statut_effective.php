


<p>
	<?php 


	include ("connect.php");
		$bdd = connectBDD();

	// creation du nouveau statut

	if ($_POST['bouton_statut'] == "Valider exceptionnel")
	{
		$req = $bdd->query('INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav_update'].'"),NOW(),"'.$_POST['exceptionnel'].'");'); 
	}
	else 
	{
		$req = $bdd->query('INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav_update'].'"),NOW(),"'.$_POST['bouton_statut'].'");'); 

	}
	?>
</p>

	<meta http-equiv="refresh" content="0 ../index.php"> pour revenir à la page home
