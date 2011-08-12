<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): // PARA EDITAR UNA CITA
		$id = $_GET['id'];
		$sql = "select nro_cita, rod_tipo, rod_notas, piel_callos from citas where nro_cita='$id';";
		$result = mysql_query($sql);	
		$row = mysql_fetch_array($result);
?>

<form action="rodillas.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<h2> Rodillas </h2>
	<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Tipo de Rodillas:
		</th>
		<td>
			<select name="rod_tipo">
				<?php if ($row["rod_tipo"] == "Valgas") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgas" SELECTED>Valgas
					<option value="Varas">Varas
					<option value="Recurvatum">Recurvatum
					<option value="Normal">Normal
				<?php } elseif ($row["rod_tipo"] == "Varas") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgas">Valgas
					<option value="Varas" SELECTED>Varas
					<option value="Recurvatum">Recurvatum
					<option value="Normal">Normal
				<?php } elseif ($row["rod_tipo"] == "Recurvatum") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgas">Valgas
					<option value="Varas">Varas
					<option value="Recurvatum" SELECTED>Recurvatum
					<option value="Normal">Normal
				<?php } elseif ($row["rod_tipo"] == "Normal") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgas">Valgas
					<option value="Varas">Varas
					<option value="Recurvatum" >Recurvatum
					<option value="Normal" SELECTED>Normal					
				<?php } else {?>
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Valgas">Valgas
					<option value="Varas">Varas
					<option value="Recurvatum">Recurvatum
					<option value="Normal">Normal
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Notas: 
		</th>
		<td>	
			<textarea name="rod_notas" rows="3" cols="30"><?php echo $row["rod_notas"] ?></textarea>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Piel:Callos Nivel: 
		</th>
		<td>	
			<textarea name="piel_callos" rows="3" cols="30"><?php echo $row["piel_callos"] ?></textarea>
		</td>
	</tr>	
	</table>
	</br>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php 
	else: // Pagina mostrada por defecto
	
	if ( isset($_POST['editsubmit'])) { // Accion de EDITAR
		$id = $_POST['nro_cita']; // Identificador del nro_cita que se va a editar.
		$rod_tipo = $_POST['rod_tipo'];
		$rod_notas = $_POST['rod_notas'];
		$piel_callos = $_POST['piel_callos'];
		$sql = "UPDATE citas SET
				rod_tipo = '$rod_tipo',
				rod_notas = '$rod_notas',
				piel_callos = '$piel_callos'
				WHERE nro_cita='$id';";	
		
		if (@mysql_query($sql)) {
			echo('<p>Su cita ha sido Actualizada. </p>');
		} else {
			echo ('<p>Ocurrio un Error al actualizar su cita: '.mysql_error().'</p>');
		}
	}
	
	if (isset($_GET['cit'])) 
	{   
		$cit = $_GET['cit'];
		$sql = "SELECT nro_cita, nro_doc, rod_tipo, rod_notas, piel_callos FROM citas WHERE nro_cita='$cit';";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows($result);		
		
		#Obtener resultado de fila
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
	
		echo "<h3>Podograma . Diagnostico . Rodillas y Piel</strong> . 
		<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
		$pacapellido1 $pacapellido2 </a></h3><hr/><br/>";
		echo "<table border=1 cellpadding='10' width=375>\n";
		printf("<tr><th width=125><b>Tipo (Rodillas):</b></th><td>%s</td></tr>", $row["rod_tipo"]);
		printf("<tr><th><b>Notas:</td><td>%s</b></th></tr>", $row["rod_notas"]);
		printf("<tr><th><b>Piel Callos:</b></th><td>%s</td></tr>", $row["piel_callos"]);
		echo "</table>\n";
		echo "</br>\n";
		printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n", 
			$_SERVER['PHP_SELF'], $row["nro_cita"]);
		printf("<a class='button' href=\"citas.php?num=$cit\">Volver</a>");
		echo "<br><br></br>\n";
	}
	endif;
	require("footer.php");
?>
					