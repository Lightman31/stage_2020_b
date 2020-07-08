<main id= "corps">

	<h1>
		Recherches
	</h1>




	<!-- Création -->
	<form action="back/creation_sav.php" method="post">
		<p>
			<label for="pseudo">Création SAV</label>
			<input type="text" placeholder="Num SAV" name="num_sav4">
			UID carte
			<input type="text" placeholder="UID : xxx-xxx-xxx-xxx-xxx" name="UID">
			<select name="statut21" >
	    		<option value="">Emplacement</option>
	    		<option value="labo">labo</option>
	    		<option value="atelier">atelier</option>
	    		<option value="gravure">gravure</option>
	    		<option value="logistique">logistique</option>
			</select>
			<input type="submit" value="Créer SAV">
		</p>
	</form>

	<!-- Mise à jour UID  -->

	<form action="back/MAJ_UID.php" method="post">
		<p>
			<label for="pseudo">Mise à jour UID</label>
			<input type="text" placeholder="Num SAV" name="num_sav5">
			Nouvel UID carte
			<input type="text" placeholder="UID : xxx-xxx-xxx-xxx-xxx" name="UID">
			<input type="submit" value="MAJ">
		</p>
	</form>


	<!-- deadline -->
	<form action="back/MAJ_deadlineby_num_sav.php" method="post">
		<p>
			<label for="pseudo">Mettre à jour une deadline de SAV</label>
			<input type="text" placeholder="num SAV" name="num_sav3" />

		Deadline
		<input type="date" name="ddline">
		<input type="submit"  value="MAJ" />
		</p>
	</form>

	<!-- Edit Note -->
	<form action="back/MAJ_note.php" method="post">
		<p>
			<label for="pseudo">Mise à jour note // ne fonctione pas encore  </label>
			<input type="text" placeholder="Num SAV" name="num_sav6">
			Commentaire à ajouter
			<input type="text" placeholder="texte" name="commentaire">
			<input type="submit" value="MAJ">
			a faire 
		</p>
	</form>

	<!-- tri par deadline -->
	<p>
	<form action="back/tri.php" method="post">
		<p>
		<button  type="submit">test</button>
		</p>
	</form>
	</p>
</main>