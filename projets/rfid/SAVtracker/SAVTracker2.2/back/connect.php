



<?php

	function connectBDD()
	{
		$bdd = new PDO ('mysql:host=localhost;dbname=blet;charset=utf8','root','root');
		return $bdd;
	}

?>







