

<?php

    if (isset($_POST['bouton_statut'])) {   


        // creation du nouveau statut

        if ($_POST['bouton_statut'] == "Valider")
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

        if ($_POST['bouton_localisation'] == "Valider")
        {
            $req = $bdd->query('INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES((SELECT SAV.id_sav FROM SAV where SAV.num_sav = "'.$_POST['num_sav1'].'"),NOW(),"'.$_POST['exceptionnel'].'");'); 
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



	<p>

	<?php 
	// MAJ du sav a modifier
    	include ("front/menu.php"); 
		$req = $bdd->query('SELECT * FROM SAV WHERE SAV.num_sav = "'.$_POST['num_sav1'].'"'); 
		//echo 'SELECT SAV.num_sav, SAV.deadline, SAV.UID, SAV.emplacement, SAV.note FROM SAV, Statut WHERE SAV.num_sav = "'.$_POST['num_sav1'].'" AND SAV.id_sav = Statut.sav ORDER BY Statut.inf_dat;';
		
		echo '<h1>INFO SAV</h1>';
		if ($donnees = $req->fetch())
		{
			echo '<h3><table>';
			echo '<tr><td>numero de SAV .  </td><td>  '.$donnees['num_sav'];
			echo '</td></tr><tr><td>UID  </td><td>'.$donnees['UID'];
			echo '</td></tr><tr><td>echance </td><td>'.$donnees['echeance'];
			echo '</td></tr></table> </h3>';
		}
		else
		{
			echo ' <FONT color="red"> <h1>Ce numero de SAV n\'est pas attribue</h1> </FONT> ';
		}




	?>
	</p>


	<p>
	<p>

		<form action="bandeau_2.php" method="post">
			<p>
				<?php
				echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
				?>
				<h2>MAJ Echeance</h2>
				</br>
				<input type="date" name="echance" />
			    <input type="submit" name = "bouton_echance" value="Valider"/>
			</p>
		</form>

		<div class="container-fluid">
			<form action="bandeau_2.php" method="post" class ="row  col-lg-12">
					<?php
					echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
					?>
					<h2>MAJ Statut</h2>

				<table class ="table table-striped">

					<tr class = "row col-lg-12">
						<!-- <div class="col-md-1"></div> -->
						<td class="col-lg-2"><input type="text" placeholder="statut exceptionnel"  name="exceptionnel" /></td>
					    <td><input type="submit" name = "bouton_statut" value="Valider"/></td>
					</tr>
					<tr class = "row col-lg-12">
					    <td><input type="submit" name = "bouton_statut" value="Arrivée client"/></td>
					    <td><input type="submit" name = "bouton_statut" value="Arrivée Usines"/></td> 
					    <td><input type="submit" name = "bouton_statut" value="Départ Usines"/></td> 
					</tr><tr class = "row col-lg-12">
					    <td><input type="submit" name = "bouton_statut" value="Expertise"/></td>
					    <td><input type="submit" name = "bouton_statut" value="Exécution"/></td>
					</tr><tr class = "row col-lg-12">
					    <td><input type="submit" name = "bouton_statut" value="Vérifié" /></td>
					    <td><input type="submit" name = "bouton_statut" value="Fin" /></td>
					</tr>
				</table>
			</form>
		</div>



		<div class="container-fluid">
			<form action="bandeau_2.php" method="post" class ="row  col-lg-12">
				<p>
					<?php
					echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
					?>
					<h2>MAJ Emplacement</h2>

				<table class ="table table-striped">
					<tr class = "row col-lg-12">
					
					<td class="col-lg-2"><input type="text" placeholder="Emplacement exceptionnel"  name="exceptionnel" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Valider"/></td>
				</tr><tr class = "row col-lg-12">
				     <td><input type="submit" name = "bouton_localisation" value="Bureau" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Logistique Entrée" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Logistique Sortie" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Sortie de Prod" /></td>
				</tr><tr class = "row col-lg-12">
				     <td><input type="submit" name = "bouton_localisation" value="Labo" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Labo 2" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Labo 3" /></td>
				</tr><tr class = "row col-lg-12">
				     <td><input type="submit" name = "bouton_localisation" value="Zone Atelier" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Zone Cable" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Zone Electronique" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Zone Gravure" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Zone Usinage" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Zone Reparation" /></td>
				     <td><input type="submit" name = "bouton_localisation" value="Expertise" /></td>
				</p>
			</form>
		</div>



	</p>





