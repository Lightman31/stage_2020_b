<!DOCTYPE html>
<html>
    <head>
        <title>Ceci est une page de test </title>
        <meta charset="utf-8" />
    </head>
    <body>
    	<h1>
    		Recherches
    	</h1>

    	<!-- Recherche -->
		<form action="recherche_sav_by_num_sav.php" method="post">
		<p>
			<label for="pseudo">Recherche de SAV par numero de SAV :</label>
		    <input type="text" placeholder="Num SAV"  name="num_sav1" />
		    <input type="submit"  value="Lancer recherche de SAV" />
		</p>
		</form>


		<!-- Création -->
		<form action="creation_sav.php" method="post">
			<p>
				<label for="pseudo">Création SAV</label>
				<input type="text" placeholder="Num SAV" name="num_sav4">
				UID carte
				<input type="text" placeholder="UID : xxx-xxx-xxx-xxx-xxx" name="UID">
				Emplacement
				<select name="statut12" >
		    		<option value="">statut</option>
		    		<option value="labo">labo</option>
		    		<option value="atelier">atelier</option>
		    		<option value="etallonage OK">etallonage OK</option>
		    		<option value="logitique">logistique</option>
				</select>
				<input type="submit" value="Créer SAV">
			</p>
		</form>

		<!-- statut SAV -->
		<form action="MAJ_savby_num_sav.php" method="post">
		<p>
			<label for="pseudo">Mettre un jour un statut de SAV :</label>
		    <input type="text" placeholder="Num SAV"  name="num_sav2" />



		emplacement : 
			<input type="radio" name="emplacement" value="logitique" id="emplacement" checked="checked" /> <label for="logitique">logitique</label>
			<input type="radio" name="emplacement" value="labo" id="emplacement" /> <label for="labo">labo</label>
			<input type="radio" name="emplacement" value="gravure" id="emplacement" /> <label for="gravure">gravure</label>
			<input type="radio" name="emplacement" value="atelier" id="emplacement" /> <label for="atelier">atelier</label>
			<select name="statut11" >
		    	<option value="">statut</option>
		    	<option value="labo">labo</option>
		    	<option value="atelier">atelier</option>
		    	<option value="etallonage OK">etallonage OK</option>
		    	<option value="logitique">logistique</option>
			</select>
			<input type="text" placeholder="complement de statut"  name="statut12" />
			<input type="submit"  value="MAJ" />
		</p>
		</form>

		<!-- deadline -->
		<form action="MAJ_deadlineby_num_sav.php" method="post">
			<p>
				<label for="pseudo">Mettre à jour une deadline de SAV</label>
				<input type="text" placeholder="num SAV" name="num_sav3" />

			Deadline
			<input type="date" name="ddline">
			<input type="submit"  value="MAJ" />
			</p>
		</form>
    </body>
</html>
