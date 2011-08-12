<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>
<html>
	<head>
		<title> Busqueda de Citas </title>
	</head>

	<body>
		<h2> Busqueda de Citas </h2>
		<hr>
		</br>
		<form action="rescit.php" method="post">
		<table border=1 cellpadding='10'>	
		<tr><th>Escoja el campo:</th>
			<td><select name="searchtype">
				<option value="nro_cita">No. de Cita
				<option value="fecha">Fecha
				<option value="nro_doc">Doc. de Paciente
				<option value="doctor">Nombre del Medico
				<option value="institucion">Institucion
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
				