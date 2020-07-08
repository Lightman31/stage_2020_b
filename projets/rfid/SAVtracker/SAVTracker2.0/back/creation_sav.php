<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
	<title>SAV</title>
</head>
<body>
	<p>
	requete :<br/> 
	<?php 
	// MAJ du sav a modifier
	include ("connect.php");
		$bdd = connectBDD();
		if ($_POST['statut21'] == "")
		{
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,emplacement,UID) VALUES ( ?,"logistique",?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['UID'])) ;

			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav4'].'"),NOW(),"logistique");'); 
		}
		else
		{
			$req = $bdd->prepare('INSERT INTO SAV(num_sav,emplacement,UID) VALUES ( ?,?,?);'); 
			$req->execute(array($_POST['num_sav4'],$_POST['statut21'],$_POST['UID'])) ;

			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav4'].'"),NOW(),"'.$_POST['statut21'].'");'); 

		}
		echo 'ligne ajoutée<br />	';
		$lis = $bdd->query('SELECT * FROM SAV ORDER BY num_sav;');
		while ($donnees = $lis->fetch())
		{
			echo $donnees['num_sav'],' ',$donnees['UID'],' ',$donnees['emplacement'] , '<br />';
		}	
		
	?>
	</p>

	<p>
			<meta http-equiv="refresh" content="0 ../index.php"> pour revenir à la page home
	</p>
</body>
