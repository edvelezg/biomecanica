<?php
	require("db.php");
	require("functions.php");
	
	//$validid = pf_validate_number($_GET['id'], "redirect", $config_basedir);
	
	// Mostrar la Imagen.
	if (isset($_GET['id'])) 
	{   
		require("header.php");
		$id = $_GET['id'];
		echo "<a href=foto.php?large=$id>";
		echo "<img width=600 src='./uploads/$id"."' alt='La imagen no se encuentra en el directorio /uploads/'>";
		echo "</a>";
	}
	
	if (isset($_GET['large']))
	{
		$large = $_GET['large'];
		printf("<img src='./uploads/$large"."' alt='La imagen no se encuentra en el directorio /uploads/'>");
	}

	require("footer.php");
?>
					