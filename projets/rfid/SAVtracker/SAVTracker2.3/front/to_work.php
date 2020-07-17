






<table class ="table table-striped">
	<thread class="thread-dark">
		<tr>
			<th scope = "col">Num</th>
			<th scope = "col">Statut</th>
			<!-- <th scope = "col">date_Statut</th> -->
			<th scope = "col">Emplacement</th>
			<!-- <th scope = "col">date_Emplacement</th> -->
			<th scope = "col">Écheance</th>
		</tr>
	</thread>
	<tbody>

		<?php 
		// MAJ du sav a modifier
		$reponse = $bdd->query('SELECT * FROM SAV WHERE echeance IS NOT NULL ORDER BY echeance ASC ;');




		while ($donnees = $reponse->fetch())
		{
			$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) AND Statut.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 

			$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) AND Emplacement.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 


			if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()))
			{
				if ($line_query_statut['nom_statut'] == 'En etallonage' || $line_query_statut['nom_statut'] == 'En Atelier' || $line_query_statut['nom_statut'] == 'En attente' || $line_query_statut['nom_statut'] == 'Arrivée' || $line_query_statut['nom_statut'] == 'Juste arrive')
				{
					echo '<tr><th scope = "row">';
					echo $donnees['num_sav'];
					echo'</td><td>';

					echo $line_query_statut['nom_statut'].'</td><td>';
					// echo $line_query_statut['inf_dat_statut']. '</td><td>';
					echo $line_query_emplacement['nom_emplacement'].'</td><td>';
					// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
					if ($donnees['echeance'] <= date('Y-m-d'))
					{
						echo '<FONT color="red">';
						echo $donnees['echeance']  ;
						echo '</FONT>';

					}
					else 
					{
						echo $donnees['echeance'];
					}					
					echo '</td></tr>';

				}

			}

		}

		// MAJ du sav a modifier
		$reponse = $bdd->query('SELECT * FROM SAV WHERE echeance IS NULL ;');




		while ($donnees = $reponse->fetch())
		{
			$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) AND Statut.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 

			$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) AND Emplacement.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 




			if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()))
			{
				if ($line_query_statut['nom_statut'] == 'En etallonage' || $line_query_statut['nom_statut'] == 'En Atelier' || $line_query_statut['nom_statut'] == 'En attente' || $line_query_statut['nom_statut'] == 'Arrivée' || $line_query_statut['nom_statut'] == 'Juste arrive')
				{
					echo '<tr><th scope = "row">';
					echo $donnees['num_sav'];
					echo'</td><td>';

					echo $line_query_statut['nom_statut'].'</td><td>';
					// echo $line_query_statut['inf_dat_statut']. '</td><td>';
					echo $line_query_emplacement['nom_emplacement'].'</td><td>';
					// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
					echo $donnees['echeance']  ;
					echo '</td></tr>';
					
				}

			}

		}		

		



		?>
	</tbody>
</table>









