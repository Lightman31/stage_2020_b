<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
$bdd = new PDO ('mysql:host=localhost;dbname=blet;charset=utf8','root','root');
		$reponse = $bdd->query('SELECT num_sav,nom_sav,UID,emplacement,note,deadline FROM SAV ORDER BY deadline;'); 

		$donnees = $reponse->fetch();	
		echo $donnees['num_sav'];
	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>