<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
		$bdd = new PDO ('mysql:host=localhost;dbname=blet;charset=utf8','root','root');
		if ($_POST['statut21'] == "")
		{
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,emplacement,UID) VALUES ( ?,logistique,?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['UID'])) ;
		}
		else
		{
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,emplacement,UID) VALUES ( ?,?,?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['statut21'],$_POST['UID'])) ;
		}
		

		$donnees = $req->fetch();	
		echo $donnees['num_sav'];
	?>
</p>

<p>
	<a href="formulaire.php">clique ici</a> pour revenir à la page du formulaire</p>