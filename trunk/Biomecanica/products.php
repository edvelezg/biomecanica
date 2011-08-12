<?php
	require("db.php");
	require("functions.php");
	
	$validid = pf_validate_number($_GET['id'], "redirect", $config_basedir);
	
	require("header.php");
	
	$query = "SELECT * from  PACIENTES;";
	$resultado = mysql_query($query);
	$numrows = mysql_num_rows($resultado);		
	
	if ($numrows == 0)
	{
		echo "<h1> No Hay Pacientes </h1>";
		echo "No hay pacientes.";
	}

	else 
	{
		echo "<table border=1>\n";
		echo "<tr><td>Nro de Documento</td><td>Nombre</td><td>Apellidos</td></tr>\n";
		
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td>%s</td><td>%s</td><td>%s %s<td></tr>\n", $row["nro_doc"],
			$myrow["nombre"], $row["apellido1"], $row["apellido2"]);
		}
		
		echo "</table>\n";
	}

	require("footer.php");
?>
					