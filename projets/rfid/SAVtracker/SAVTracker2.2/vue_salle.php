<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
        <title>SAV blet </title>
        <meta charset="utf-8" />
    </head>

    	<?php 
                include ("back/connect.php");

    $bdd = connectBDD();
        include ("front/menu.php"); ?>
    <body onload="document.getElementById('num_sav1').focus()">



    </body>
    <?php include ("front/overview.php"); 
    echo '<meta http-equiv="refresh" content="1"> ';
    ?>
</html>

