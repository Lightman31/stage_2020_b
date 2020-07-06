<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
		$bdd = new PDO ('mysql:host=localhost;dbname=blet;charset=utf8','root','root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$req = $bdd->prepare('SELECT Statut.nom_statut, Statut.inf_dat FROM SAV, Statut WHERE SAV.num_sav = ? AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat;'); 
		$req->execute(array($_POST['num_sav1'])) ;

		$donnees = $req->fetch();	
		echo $donnees['nom_statut'],' ', $donnees['inf_dat'];
	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>