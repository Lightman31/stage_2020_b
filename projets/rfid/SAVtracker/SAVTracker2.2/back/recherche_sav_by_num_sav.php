<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/tuto.css" rel="stylesheet">
	<title>SAV</title>
</head>
<body><!--
	<p>

	<?php /*
	// MAJ du sav a modifier
	include ("connect.php");
		$bdd = connectBDD();
		
		$req = $bdd->query('SELECT * FROM SAV WHERE SAV.num_sav = "'.$_POST['num_sav1'].'"'); 
		//echo 'SELECT SAV.num_sav, SAV.deadline, SAV.UID, SAV.emplacement, SAV.note FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat;';
		
		echo '<h1>INFO SAV</h1>';
		if ($donnees = $req->fetch())
		{
			echo '<table>';
			echo '<tr><td>numero de SAV : </td><td>'.$donnees['num_sav'].'</tr></td><tr><td>UID : </td><td>'.$donnees['UID'];
			echo '</table>';
		}
		else
		{
			echo 'Ce numero de SAV nest pas attribue';
		}




		$req = $bdd->query('SELECT * FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat_statut DESC;'); 

		echo '<h1>historique des statut</h1>';
		echo '<table>';
		while ($donnees = $req->fetch())
		{
			echo '<tr><td>';
			echo $donnees['inf_dat_statut'].' : </td><td>'. $donnees['nom_statut'];
			echo '</td></tr>';
		}
		echo '</table>';*/
	?>
	</p>

	<p>
	<a href="../index.php">clique ici</a> pour revenir à la page du formulaire</p>-->

	<h1>Num SAV <b><?php  echo $_POST['num_sav1'] ?> </b></h1>
	<section class="row">
		<div class ="col-md-2">
			<?php

					echo '<h3> UID : </h3>';
					echo '<h3> Echeance :</h3>';
			?>		
		</div>
		<div class ="col-md-6">
			<?php  
				include ("connect.php");
				$bdd = connectBDD();
				$data = $bdd->query('SELECT * FROM sav WHERE num_sav="'.$_POST['num_sav1'].'";');
				if ($line_data = $data->fetch())
				{
					echo '<h3>';
					echo $line_data['UID'];
					echo '</ h3>';
					echo '<h3>';
					echo $line_data['echeance'];
					echo '</ h3>';
				}
			?>
		</div>
	</section>
	<section class="row">
		<div class="col-xs-5">
			
		
		<table class ="table table-striped">
	<thread class="thread-dark">
		<tr>
			<th scope = "col">Emplacement</th>
			<th scope = "col">Enregistrement</th>
		</tr>
	</thread>
	<tbody>

		<?php 
		// MAJ du sav a modifier
		
		

		$reponse = $bdd->query('SELECT emplacement.nom_emplacement,emplacement.inf_dat_emplacement FROM emplacement,sav WHERE emplacement.sav = (SELECT id_sav FROM sav WHERE num_sav="'.$_POST['num_sav1'].'") ORDER BY inf_dat_emplacement DESC;');
/*
		$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) GROUP BY sav ;'); 

		$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) GROUP BY sav ;'); 
*/

		while ($emplacement = $reponse->fetch())
		{
			//if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()))
			//{

			echo '<tr><th scope = "row">';
			echo $emplacement['nom_emplacement'];
			echo'</td><td>';
			echo $emplacement['inf_dat_emplacement'];
			echo'</td><td>';
			//echo $line_query_statut['nom_statut'].'</td><td>';
			// echo $line_query_statut['inf_dat_statut']. '</td><td>';
			//echo $line_query_emplacement['nom_emplacement'].'</td><td>';
			// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
			//echo $donnees['echeance'].'</td><td>';
			//echo $donnees['UID']  ;

			echo '</td></tr>';
			//}
		}	
		?>
		</tbody>
		</table>
		</div>
		<div class="col-xs-5">
			
		
		<table class ="table table-striped">
	<thread class="thread-dark">
		<tr>
			<th scope = "col">Statut</th>
			<th scope = "col">Enregistrement</th>
		</tr>
	</thread>
	<tbody>

		<?php 
		//include ("connect.php");
		//$bdd = connectBDD();
		$statut = $bdd->query('SELECT statut.nom_statut,statut.inf_dat_statut FROM statut,sav WHERE statut.sav = (SELECT id_sav FROM sav WHERE num_sav="'.$_POST['num_sav1'].'") ORDER BY inf_dat_statut DESC;');
/*
		$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) GROUP BY sav ;'); 

		$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) GROUP BY sav ;'); 
*/

		while ($line_statut = $statut->fetch())
		{
			//if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()))
			//{

			echo '<tr><th scope = "row">';
			echo $line_statut['nom_statut'];
			echo'</td><td>';
			echo $line_statut['inf_dat_statut'];
			echo'</td><td>';
			//echo $line_query_statut['nom_statut'].'</td><td>';
			// echo $line_query_statut['inf_dat_statut']. '</td><td>';
			//echo $line_query_emplacement['nom_emplacement'].'</td><td>';
			// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
			//echo $donnees['echeance'].'</td><td>';
			//echo $donnees['UID']  ;

			echo '</td></tr>';
			//}
		}	
		?>
		</tbody>
		</table>
		</div>
	</section>
	
</body>

