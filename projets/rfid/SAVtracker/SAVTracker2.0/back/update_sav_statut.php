





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

	<?php 
	// MAJ du sav a modifier
	include ("connect.php");
		$bdd = connectBDD();
		
		$req = $bdd->query('SELECT SAV.num_sav, SAV.deadline, SAV.UID, SAV.emplacement, SAV.note FROM SAV WHERE SAV.num_sav = "'.$_POST['num_sav1'].'"'); 
		//echo 'SELECT SAV.num_sav, SAV.deadline, SAV.UID, SAV.emplacement, SAV.note FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat;';
		
		echo '<h1>INFO SAV</h1>';
		if ($donnees = $req->fetch())
		{
			echo '<table>';
			echo '<tr><td>numero de SAV : </td><td>'.$donnees['num_sav'].'</tr></td><tr><td>emplacement: </td><td>'.$donnees['emplacement'].'</tr></td><tr><td>deadline: </td><td>'.$donnees['deadline'].'</tr></td><tr><td>UID : </td><td>'.$donnees['UID'].'</tr></td><tr><td>note:</td><td> '.$donnees['note'];
			echo '</table>';
		}
		else
		{
			echo 'Ce numero de SAV nest pas attribue';
		}




	?>
	</p>


	<p>

			<form action="update_sav_statut_effective.php" method="post">
			<p>
				<?php
				echo '<input type="text" name="num_sav_update" value = "'.$_POST['num_sav1'].'" />';
				?>
				</br>
				<input type="text" placeholder="statut exceptionnel"  name="exceptionnel" />
			    <input type="submit" name = "bouton_statut" value="Valider exceptionnel"/>
			</br></br>
			    <input type="submit" name = "bouton_statut" value="retour client"/>
			    <input type="submit" name = "bouton_statut" value="usine" />
			    <input type="submit" name = "bouton_statut" value="destruction" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 1" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 2" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 3" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 4" />
			    <input type="submit" name = "bouton_statut" value="Devis à faire" />
			    <input type="submit" name = "bouton_statut" value="Devis fait" />
			    <input type="submit" name = "bouton_statut" value="Devis accepté" />
			    <input type="submit" name = "bouton_statut" value="Attente commerciale" />
			    <input type="submit" name = "bouton_statut" value="H.S." />
			    <input type="submit" name = "bouton_statut" value="Labo" />
			    <input type="submit" name = "bouton_statut" value="Atelier" />
			    <input type="submit" name = "bouton_statut" value="expertise en cours" />
			    <input type="submit" name = "bouton_statut" value="wingard" />
			    <input type="submit" name = "bouton_statut" value="Dossier cloturé" />
			</p>
		</form>

	</p>

	<p>
	<a href="../home.php">clique ici</a> pour revenir à la page du formulaire</p>
</body>

