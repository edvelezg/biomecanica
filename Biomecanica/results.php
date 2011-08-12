<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<html>
<head>
	<title> Resultados de Pacientes </title>
</head>
<body>
<h1> Resultados de Pacientes </h1>

<?php
	trim($searchterm);
	if (!$_POST['searchtype'] || !$_POST['searchterm'])
	{
		echo "No haz ingresado detalles de la busqueda. Favor devolverse e intentar de nuevo.";
		exit;
	}
	$searchtype = $_POST['searchtype'];
	$searchterm = $_POST['searchterm'];
	
	$searchtype = addslashes($searchtype);
	$searchterm = addslashes($searchterm);
	
	@ $db = mysql_pconnect("localhost", "root", "flibble");
	
	if (!$db) {
		echo "Error: Could not connect to database. Please try again later.";
	}
	mysql_select_db("biomecanica");
	
	if ($searchtype == "nro_doc") {
		$query = "select * from paciente where ".$searchtype." = '".$searchterm."';";
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
	} 
	else {
		$query = "select * from paciente where ".$searchtype." like '%".$searchterm."%';";
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
	}
	
	if ($numrows == 0)
	{
		echo "<h1> No Hay Pacientes </h1>";
		echo "No hay pacientes.";
	}
	echo "<p>Numero de Pacientes encontrados: ".$numrows."</p>";
	
		echo "<table border=1 cellpadding='10'>\n";
		echo "<tr><td><b>Nro de Documento</b></td><td><b>Nombre</b></td><td><b>Apellidos</b></td></tr>\n";
		
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td><a href=\"pacientes.php?num=%s\">%s</a></td><td>%s</td><td>%s %s</td></tr><br>\n",
			$row["nro_doc"], $row["nro_doc"], $row["nombre"], $row["apellido1"], $row["apellido2"]);
		}
		
		echo "</table>\n";
		
	require("footer.php");
?>

	
		