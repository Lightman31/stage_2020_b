<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
		echo 'UPDATE SAV SET UID = ';
		echo $_POST['UID'];
		echo ' WHERE num_sav = "',$_POST['num_sav5'];
		echo '";';
		echo 'SELECT num_sav,nom_sav,UID,emplacement,note FROM SAV WHERE num_sav = ',$_POST['num_sav5'],';'
	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>