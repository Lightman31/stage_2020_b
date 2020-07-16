

<div class="container" role = "navigation" >
	<nav class="navbar navbar-inverse">

		<div class ="container-fluid">
			<div class="navbar-header">
				<a class = "navbar-brand" href="index.php">SAV</a>
				
			</div>
			<ul class ="nav navbar-nav">
				<li class="active"> <a href="index.php">Overview</a></li>
				<li> <a href="develloper.php">Develloper</a></li>
			</ul>
	    

			<form class ="navbar-form navbar-right inline-form" action="back/infos_MAJstatut.php" method="post">
				<p>
					<input type="text" placeholder="Num SAV" id = "num_sav1" name="num_sav1" />
				    <input type="submit" name = "bouton"  value="Lancer recherche d'infos" />
				    <input type="submit" name = "bouton" value="Mettre à jour le statut" />
				</p>
			</form>
		</div>
	</nav>
</div>