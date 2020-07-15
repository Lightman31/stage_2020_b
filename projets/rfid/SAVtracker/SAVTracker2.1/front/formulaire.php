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


</main>