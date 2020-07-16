
	<?php 
	// MAJ du sav a modifier
	include ("connect.php");
		$bdd = connectBDD();
		$req = $bdd->query('UPDATE SAV SET UID = '.$_POST['UID'].' WHERE num_sav = "'. $_POST['num_sav5'].'";'); 

		echo '<meta http-equiv="refresh" content="0 ../index.php">';  
	?>
