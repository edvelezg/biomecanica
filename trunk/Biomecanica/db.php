<?php

	require("config.php");
	
	// Conectandose al Servidor de Bases de datos.
	$db = @mysql_connect($dbhost, $dbuser, $dbpassword);
	if (!$db) {
		die ( '<p>No fue posible conectarse al ' . 'servidor de bases de datos en este momento.</p>' );
	}
	
	// Seleccionando la Base de Datos de Biomecanica
	if (! @mysql_select_db($dbdatabase, $db) ) {
		die ( '<p>No se encontro la base de datos de Biomecanica ' . 'en este momento.</p>' );
	}

?>