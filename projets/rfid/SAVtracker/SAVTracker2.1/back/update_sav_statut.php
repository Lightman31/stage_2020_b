





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
		
		$req = $bdd->query('SELECT * FROM SAV WHERE SAV.num_sav = "'.$_POST['num_sav1'].'"'); 
		//echo 'SELECT SAV.num_sav, SAV.deadline, SAV.UID, SAV.emplacement, SAV.note FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat;';
		
		echo '<h1>INFO SAV</h1>';
		if ($donnees = $req->fetch())
		{
			echo '<table>';
			echo '<tr><td>numero de SAV  </td><td>'.$donnees['num_sav'];
			echo '</tr></td><tr><td>UID  </td><td>'.$donnees['UID'];
			echo '</tr></td><tr><td>echance </td><td>'.$donnees['echeance'];
			echo '</table>';
		}
		else
		{
			echo 'Ce numero de SAV nest pas attribue';
		}




	?>
	</p>


	<p>
	<p>
	<a href="../index.php">clique ici</a> pour revenir à la page du formulaire</p>

			<form action="update_sav_statut.php" method="post">
			<p>
				<?php
				echo '<input type="text" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
				?>
				<h2>MAJ Echeance</h2>
				</br>
				<input type="date" name="echance" />
			    <input type="submit" name = "bouton_echance" value="Valider"/>
			</p>
		</form>



			<form action="update_sav_statut.php" method="post">
			<p>
				<?php
				echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
				?>
				<h2>MAJ Statut</h2>
				</br>
				<input type="text" placeholder="statut exceptionnel"  name="exceptionnel" />
			    <input type="submit" name = "bouton_statut" value="Valider exceptionnel"/>
			</br></br>
			    <input type="submit" name = "bouton_statut" value="En attente comerciale"/>
			    <input type="submit" name = "bouton_statut" value="Retour client"/>
			    <input type="submit" name = "bouton_statut" value="Usine" />
			    <input type="submit" name = "bouton_statut" value="Detruit" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 1 fait, ok pour la suite" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 2 fait, ok pour la suite" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 3 fait, ok pour la suite" />
			    <input type="submit" name = "bouton_statut" value="Expertise niveau 4 fait, ok pour la suite" />
			    <input type="submit" name = "bouton_statut" value="H.S." />
			    <input type="submit" name = "bouton_statut" value="En etallonage" />
			    <input type="submit" name = "bouton_statut" value="En reparation" />
			    <input type="submit" name = "bouton_statut" value="Expertise en cours" />
			    <input type="submit" name = "bouton_statut" value="En attente" />
			    <input type="submit" name = "bouton_statut" value="Dossier cloturé" />
			</p>
		</form>



			<form action="update_sav_statut.php" method="post">
			<p>
				<?php
				echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
				?>
<h2>MAJ Localisation</h2>
				</br>
				<input type="text" placeholder="statut exceptionnel"  name="exceptionnel" />
			    <input type="submit" name = "bouton_Ordre" value="Valider exceptionnel"/>
			</br></br>
			    <input type="submit" name = "bouton_localisation" value="Usine" />
			    <input type="submit" name = "bouton_localisation" value="Detruit" />
			    <input type="submit" name = "bouton_localisation" value="Labo" />
			    <input type="submit" name = "bouton_localisation" value="Logistique" />
			    <input type="submit" name = "bouton_localisation" value="Atelier" />
			    <input type="submit" name = "bouton_localisation" value="Client" />
			    <input type="submit" name = "bouton_localisation" value="Bureau" />
			</p>
		</form>




	</p>

</body>

<?php

	if (isset($_POST['bouton_statut'])) {	


		// creation du nouveau statut

		if ($_POST['bouton_statut'] == "Valider exceptionnel")
		{
			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav1'].'"),NOW(),"'.$_POST['exceptionnel'].'");'); 
		}
		else 
		{
			$req = $bdd->query('INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav1'].'"),NOW(),"'.$_POST['bouton_statut'].'");'); 
		}
	}
	if (isset($_POST['bouton_localisation'])) {	


		// creation du nouveau statut

		if ($_POST['bouton_localisation'] == "Valider exceptionnel")
		{
			$req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_statut) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav1'].'"),NOW(),"'.$_POST['exceptionnel'].'");'); 
		}
		else 
		{
			$req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav1'].'"),NOW(),"'.$_POST['bouton_localisation'].'");'); 
		}
	}
	// UPDATE SAV SET echeance = "2020-07-25" WHERE SAV.num_sav = "16-174" 
	if (isset($_POST['bouton_echance'])) {	

		if ($_POST['echance'] == ''){
			$req = $bdd->query('UPDATE SAV SET echeance = NULL WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" '); 
		}
		else {
			$req = $bdd->query('UPDATE SAV SET echeance = "'.$_POST['echance'].'" WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" '); 
		}
	}

?>

