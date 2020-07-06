



<?php
	
	include ("connect.php");

	$bdd = connectBDD();

			$reponse = $bdd->query('SELECT num_sav,nom_sav,UID,emplacement,note,deadline FROM SAV ORDER BY deadline;'); 

		$donnees = $reponse->fetch();	
		echo $donnees['num_sav'];

?>


