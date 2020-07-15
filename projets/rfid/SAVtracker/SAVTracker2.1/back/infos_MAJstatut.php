<?php

	if($_POST['bouton'] == "Lancer recherche d'infos")
	{
		//include ("../front/menu.php"); 
	    include ("recherche_sav_by_num_sav.php"); 
	}
	else 
	{
    	include ("update_sav_statut.php"); 
	}

?>