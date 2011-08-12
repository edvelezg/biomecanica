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
		<h2> Busqueda de Pacientes </h2>
		<hr>
		</br>
		<form action="respac.php" method="post">
		<table border=1 cellpadding='10'>	
		<tr><th>Escoja el campo:</th>
			<td><select name="searchtype">
				<option value="nombre">Nombre
				<option value="nombre2">2ndo Nombre
				<option value="apellido1">1er Apellido
				<option value="apellido2">2ndo Apellido
				<option value="nro_doc">Documento
			</select></td>
		</tr>
		<tr>
			<th>Termino de Busqueda:</th>
			<td><input name="searchterm" type=text></td>
		</tr>
		<tr>
			<th colspan=2 align=right><input type=submit value="Buscar"></th>
		</tr>
		</table>
		</form>
	
	</body>
	</html>
<?php
	require("footer.php");
?>
				