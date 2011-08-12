<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>
<html>
	<head>
		<title> Busqueda de Pacientes </title>
	</head>

	<body>
		<h1> Busqueda de Pacientes </h1>
		
		<form action="results.php" method="post">
		<table border=1 cellpadding='10'>	
		<tr><td><b>Escoja el campo:</b></td>
			<td><select name="searchtype">
				<option value="nombre">Nombre
				<option value="apellido1">1er Apellido
				<option value="apellido2">2ndo Apellido
				<option value="nro_doc">Documento
			</select></td>
		</tr>
		<tr>
			<td><b>Termino de Busqueda:</b></td>
			<td><input name="searchterm" type=text></td>
		</tr>
		<tr>
			<td colspan=2 align=right><input type=submit value="Buscar"></td>
		</tr>
		</table>
		</form>
	
	</body>
	</html>
<?php
	require("footer.php");
?>
				