<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
		echo 'UPDATE SAV SET note = CONCAT((SELECT note FROM (SELECT note FROM SAV) AS X WHERE num_sav = "', $_POST['num_sav6'],'"), "',$_POST['commentaire'],'") WHERE num_sav = "',$_POST['num_sav6'],'";';
		echo 'SELECT num_sav,nom_sav,UID,emplacement,note FROM SAV WHERE num_sav = ',$_POST['num_sav6'],';'
	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>