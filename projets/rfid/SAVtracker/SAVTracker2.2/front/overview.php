






<table class ="table table-striped">
	<thread class="thread-dark">
		<tr>
			<th scope = "col">Num</th>
			<th scope = "col">Statut</th>
			<!-- <th scope = "col">date_Statut</th> -->
			<th scope = "col">Emplacement</th>
			<!-- <th scope = "col">date_Emplacement</th> -->
			<th scope = "col">Écheance</th>
			<th scope = "col">UID</th>
		</tr>
	</thread>
	<tbody>

		<?php 
		// MAJ du sav a modifier
		//$bdd = connectBDD();
		$reponse = $bdd->query('SELECT * FROM SAV;');

		$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) GROUP BY sav ;'); 

		$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) GROUP BY sav ;'); 


		while ($donnees = $reponse->fetch())
		{
			if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()))
			{

			echo '<tr><th scope = "row">';
			echo $donnees['num_sav'];
			echo'</td><td>';
			echo $line_query_statut['nom_statut'].'</td><td>';
			// echo $line_query_statut['inf_dat_statut']. '</td><td>';
			echo $line_query_emplacement['nom_emplacement'].'</td><td>';
			// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
			echo $donnees['echeance'].'</td><td>';
			echo $donnees['UID']  ;

			echo '</td></tr>';
			}

		}	

		



		?>
	</tbody>
</table>









