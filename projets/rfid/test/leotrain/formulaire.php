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

		<form action="recherche_sav_by_num_sav.php" method="post">
		<p>
			<label for="pseudo">Recherche de SAV par numero de SAV :</label>
		    <input type="text" placeholder="Num SAV"  name="num_sav1" />
		    <input type="submit"  value="Lancer recherche de SAV" />
		</p>
		</form>

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
    </body>
</html>
