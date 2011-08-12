<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): #Editar
		$id = $_GET['id'];
		
		#sql
		$sql = "select nro_cita, huellas, ep_tipo, ep_grado, ep_notas 
			from citas where nro_cita='$id';";
		$result = mysql_query($sql);	
		$row = mysql_fetch_array($result);
?>

<!-- Formulario Edicion -->
<form action="estadopies.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<h2> Editar Estado de Pies </h2>
	<table border=1 cellpadding='10'>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr>
		<th>
			Huellas Iguales:
		</th>
		<td>
			<?php if ($row["huellas"] == 1) { ?>
				<input type="checkbox" name="huellas" CHECKED>
			<?php } ?>
			<?php if ($row["huellas"] == 0) { ?>
				<input type="checkbox" name="huellas">
			<?php } ?>
		</td>
	</tr>
	<tr>
		<th>
			Tipo de Pie:
		</th>
		<td>
			<select name="ep_tipo">
				<?php if ($row["ep_tipo"] == "Normal") {?>
					<option value="">Seleccione un tipo...
					<option value="Normal" SELECTED>Normal
					<option value="Plano">Plano
					<option value="Cavo">Cavo
				<?php } elseif ($row["ep_tipo"] == "Plano") {?>
					<option value="">Seleccione un tipo...
					<option value="Normal">Normal
					<option value="Plano" SELECTED>Plano
					<option value="Cavo">Cavo
				<?php } elseif ($row["ep_tipo"] == "Cavo") {?>
					<option value="">Seleccione un tipo...
					<option value="Normal">Normal
					<option value="Plano">Plano
					<option value="Cavo" SELECTED>Cavo
				<?php } else {?>
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Normal">Normal
					<option value="Plano">Plano
					<option value="Cavo">Cavo
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr> 
		<th> 
			Grado (Pies):
		</th>
		<td>
			<input type="text" name="ep_grado" value="<?php echo $row["ep_grado"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="ep_notas" rows="3" cols="30"><?php echo $row["ep_notas"] ?></textarea>
		</td>
	</tr>
	</table>
	</br>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php 
	else: # Default Page
	if ( isset($_POST['editsubmit'])) { # Accion Editar
		
		# Recolectar Informacion
		$id = $_POST['nro_cita'];
		if ($_POST['huellas'] == 'on')
			$huellas = 1;
		else
			$huellas = 0;
		$ep_tipo = $_POST['ep_tipo'];
		$ep_grado = $_POST['ep_grado'];
		$ep_notas = $_POST['ep_notas'];
		
		#sql
		$sql = "UPDATE citas SET
				ep_tipo = '$ep_tipo',
				ep_grado = '$ep_grado',
				ep_notas = '$ep_notas',
				huellas = '$huellas'
				WHERE nro_cita='$id'";	
		
		if (@mysql_query($sql)) {
			echo('<p>Su cita ha sido Actualizada. </p>');
		} else {
			echo ('<p>Ocurrio un Error al actualizar su cita: '.mysql_error().'</p>');
		}
	}
	if (isset($_GET['cit'])) 
	{   
		$cit = $_GET['cit'];
		
		#sql
		$sql = "select nro_doc, huellas, nro_cita, ep_tipo, ep_grado, ep_notas 
			from citas where nro_cita='$cit';";
			
		$result = mysql_query($sql);
		$numrows = mysql_num_rows($result);		
		
		if ($numrows == 0) {
		
			echo "<h1> No Hay Estado de Pies para esta Cita </h1>";
			echo "No hay Estado de Pies.";
			
		} else {
		
		$row = mysql_fetch_array($result);
		
		# Obtener Paciente
		$nropac = $row["nro_doc"];
		$pacsql = "SELECT * FROM paciente WHERE nro_doc='$nropac'";
		$pacresult = mysql_query($pacsql);
		$pacrow = mysql_fetch_array($pacresult);
		$pacnombre = $pacrow["nombre"];
		$pacnombre2 = $pacrow["nombre2"];
		$pacapellido1 = $pacrow["apellido1"];
		$pacapellido2 = $pacrow["apellido2"];
		
		echo "<h3>Podograma . Diagnostico . Estado del Pie . 
			<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
			$pacapellido1 $pacapellido2</a></h3><hr><br/>";
			
		#Vista Detalle
		echo "<table border=1 cellpadding='10' width=375>\n";
			if ($row["huellas"] == 0)
				printf("<tr><th width=125><b>Huellas Iguales:</b></th><td>No</td></tr>");
			else
				printf("<tr><th width=125><b>Huellas Iguales:</b></th><td>Si</td></tr>");
			printf("<tr><th><b>Tipo:</b></th><td>%s</td></tr>", $row["ep_tipo"]);
			printf("<tr><th><b>Grado:</b></th><td>%s</td></tr>", $row["ep_grado"]);
			printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["ep_notas"]);
			echo "</table>\n";
		}
		echo "</br>\n";
		printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n", 
			$_SERVER['PHP_SELF'], $row["nro_cita"]);
		printf("<a class='button' href=\"citas.php?num=$cit\">Volver</a>");
		echo "<br><br></br>\n";
		
	}
	endif;
	require("footer.php");
?>
					