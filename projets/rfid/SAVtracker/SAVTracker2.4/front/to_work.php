






<table class ="table table-striped">
	<thread class="thread-dark">
		<tr>
			<th scope = "col">Num</th>
			<th scope = "col">Emplacement</th>
			<!-- <th scope = "col">date_Emplacement</th> -->
			<th scope = "col">Statut</th>
			<!-- <th scope = "col">date_Statut</th> -->
			<th scope = "col">Date d'entrée</th>
			<th scope = "col">Délai Théorique d'exécution</th>
		</tr>
	</thread>
	<tbody>

		<?php 
		///////////////////////////////////////////////////////////
		//ON AFFICHE LES SAV QUI ONT UN DELAIS THEORIQUE SAISIE
		///////////////////////////////////////////////////////////
		$reponse = $bdd->query('SELECT * FROM SAV WHERE delai_theorique IS NOT NULL ORDER BY delai_theorique ASC ;');


		while ($donnees = $reponse->fetch())
		{
			$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) AND Statut.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 

			$bdd->query("SET lc_time_names = 'fr_FR'");
			$query_premiere_occurence = $bdd->query(' SELECT DATE_FORMAT(inf_dat_statut, \'%d-%m-%Y\')  as date_fr  FROM Statut where inf_dat_statut IN (SELECT MIN(inf_dat_statut) FROM Statut GROUP by sav) AND Statut.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 

			$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) AND Emplacement.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 


			if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()) && ($line_query_premiere_occurence = $query_premiere_occurence->fetch()))
			{
				if ($line_query_statut['nom_statut'] != 'A détruire/cloturé' && $line_query_statut['nom_statut'] != 'Retour client/cloturé' )
				{
					echo '<tr><th scope = "row">';
					echo $donnees['num_sav'];
					echo'</td><td>';

					echo $line_query_emplacement['nom_emplacement'].'</td><td>';
					// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
					echo $line_query_statut['nom_statut'].'</td><td>';
					// echo $line_query_statut['inf_dat_statut']. '</td><td>';
					echo $line_query_premiere_occurence['date_fr'].'</td><td>' ;					
					if ($donnees['delai_theorique'] <= date('Y-m-d'))
					{
						echo '<FONT color="red">';
						echo $donnees['delai_theorique']  ;
						echo '</FONT>';

					}
					else 
					{
						echo $donnees['delai_theorique'];
					}
					echo '</td></tr>';

				}

			}

		}

		
		///////////////////////////////////////////////////////////
		//ON AFFICHE LES SAV QUI ONT UN DELAIS NON THEORIQUE SAISIE
		///////////////////////////////////////////////////////////
		$reponse = $bdd->query('SELECT * FROM SAV WHERE delai_theorique IS NULL ;');


		while ($donnees = $reponse->fetch())
		{
			$query_statut = $bdd->query(' SELECT * FROM Statut where inf_dat_statut IN (SELECT MAX(inf_dat_statut) FROM Statut GROUP by sav) AND Statut.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 

			$query_emplacement = $bdd->query(' SELECT * FROM Emplacement where inf_dat_emplacement IN (SELECT MAX(inf_dat_emplacement) FROM Emplacement GROUP by sav) AND Emplacement.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 

			$bdd->query("SET lc_time_names = 'fr_FR'");
			$query_premiere_occurence = $bdd->query(' SELECT DATE_FORMAT(inf_dat_statut, \'%d-%m-%Y\')  as date_fr  FROM Statut where inf_dat_statut IN (SELECT MIN(inf_dat_statut) FROM Statut GROUP by sav) AND Statut.sav = '.$donnees['id_sav'].' GROUP BY sav ;'); 




			if (($line_query_statut = $query_statut->fetch()) && ($line_query_emplacement = $query_emplacement->fetch()) && ($line_query_premiere_occurence = $query_premiere_occurence->fetch()))
			{
				if ($line_query_statut['nom_statut'] != 'A détruire/cloturé' && $line_query_statut['nom_statut'] != 'Retour client/cloturé'&& $line_query_statut['nom_statut'] != 'Fin' )
				{
					echo '<tr><th scope = "row">';
					echo $donnees['num_sav'];
					echo'</td><td>';

					echo $line_query_emplacement['nom_emplacement'].'</td><td>';
					// echo $line_query_emplacement['inf_dat_emplacement'].'</td><td>';
					echo $line_query_statut['nom_statut'].'</td><td>';
					// echo $line_query_statut['inf_dat_statut']. '</td><td>';
					echo $line_query_premiere_occurence['date_fr'] .'</td><td>' ;
					echo $donnees['delai_theorique']  ;
					echo '</td></tr>';
					
				}

			}

		}		

		



		?>
	</tbody>
</table>









