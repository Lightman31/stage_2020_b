<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
        <title>SAV blet </title>
        <meta charset="utf-8" />
    </head>
    <body >


    </body>
<?php

        include ("connect.php");
           $bdd = connectBDD();
    if($_POST['bouton'] == "Lancer recherche d'infos")
    {
        include ("back/recherche_sav_by_num_sav.php"); 
    }
    else 
    {
        include ("back/update_sav_statut.php"); 
    }

?>
</html>

