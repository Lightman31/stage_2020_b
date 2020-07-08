






<table class ="table table-striped">
	<thread class="thread-dark">
		<tr>
			<th scope = "col">Num</th>
			<th scope = "col">lieux</th>
			<th scope = "col">deadline</th>
			<th scope = "col">UID</th>
		</tr>
	</thread>
	<tbody>
		mark
		{
			color : rgb(255,255,0);
		}

		<?php 
		// MAJ du sav a modifier
		$bdd = connectBDD();
		$reponse = $bdd->query('SELECT * FROM SAV ORDER BY deadline DESC;'); 

		while ($donnees = $reponse->fetch())
		{
			echo '<tr><th scope = "row">';
			echo $donnees['num_sav'].'</th><td>'.$donnees['emplacement'].'</td><td> <mark> '.$donnees['deadline'].'</mark></td><td>'.$donnees['UID'] ;

			echo '</td></tr>';
		}	


		?>
	</tbody>
</table>









