

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



	<p>

	<?php 
	// MAJ du sav a modifier
    	include ("front/menu.php"); 
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



			<form action="bandeau_2.php" method="post">
			<p>
				<?php
				echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
				?>
				<h2>MAJ Statut</h2>
				</br>
				<input type="text" placeholder="statut exceptionnel"  name="exceptionnel" />
			    <input type="submit" name = "bouton_statut" value="Valider"/>
			</br></br>
			    <input type="submit" name = "bouton_statut" value="En attente comerciale"/>
			    <input type="submit" name = "bouton_statut" value="Retour client"/>
			    <input type="submit" name = "bouton_statut" value="Usine" />
			    <input type="submit" name = "bouton_statut" value="Detruit" />
			    <input type="submit" name = "bouton_statut" value="H.S." />
			    <input type="submit" name = "bouton_statut" value="En etallonage" />
			    <input type="submit" name = "bouton_statut" value="En Atelier" />
			    <input type="submit" name = "bouton_statut" value="En attente" />
			    <input type="submit" name = "bouton_statut" value="Dossier cloturé" />
			</p>
		</form>



			<form action="bandeau_2.php" method="post">
			<p>
				<?php
				echo '<input type="hidden" name="num_sav1" value = "'.$_POST['num_sav1'].'" />';
				?>
<h2>MAJ Zone</h2>
				</br>
				<input type="text" placeholder="Emplacement exceptionnel"  name="exceptionnel" />
			    <input type="submit" name = "bouton_Ordre" value="Valider"/>
			</br></br>
			    <input type="submit" name = "bouton_localisation" value="Bureau" />
			    <input type="submit" name = "bouton_localisation" value="Logistique" />
			</br>
			    <input type="submit" name = "bouton_localisation" value="Labo" />
			    <input type="submit" name = "bouton_localisation" value="Labo_2" />
			    <input type="submit" name = "bouton_localisation" value="Labo_3" />
			</br>
			    <input type="submit" name = "bouton_localisation" value="Atelier" />
			    <input type="submit" name = "bouton_localisation" value="Cable" />
			    <input type="submit" name = "bouton_localisation" value="Electronique" />
			    <input type="submit" name = "bouton_localisation" value="Gravure" />
			    <input type="submit" name = "bouton_localisation" value="Usinage" />
			    <input type="submit" name = "bouton_localisation" value="Reparation" />
			    <input type="submit" name = "bouton_localisation" value="Expertise" />
			</br>
			    <input type="submit" name = "bouton_localisation" value="Usine" />
			    <input type="submit" name = "bouton_localisation" value="Client" />
			    <input type="submit" name = "bouton_localisation" value="Sortie" />
			</p>
		</form>




	</p>





