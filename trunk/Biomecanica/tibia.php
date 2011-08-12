<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): // PARA EDITAR UNA CITA
		$id = $_GET['id'];
		$sql = "select nro_cita, tob_tipo, tob_notas, 
			tib_tipo, tib_notas from citas where nro_cita='$id';";
		$result = mysql_query($sql);	
		$row = mysql_fetch_array($result);
?>

<form action="tibia.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<table border=1 cellpadding='10'>
	<caption>Tobillos</caption>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr>
		<th>
			Tipo (Tobillos):
		</th>
		<td>
		<select name="tob_tipo">
				<?php if ($row["tob_tipo"] == "Valgo") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgo" SELECTED>Valgo
					<option value="Varo">Varo
					<option value="Normal">Normal
				<?php } elseif ($row["tob_tipo"] == "Varo") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgo">Valgo
					<option value="Varo" SELECTED>Varo
					<option value="Normal">Normal
				<?php } elseif ($row["tob_tipo"] == "Normal") {?>
					<option value="">Seleccione un tipo...
					<option value="Valgo">Valgo
					<option value="Varo">Varo
					<option value="Normal" SELECTED>Normal
				<?php } else {?>
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Valgo">Valgo
					<option value="Varo">Varo
					<option value="Normal">Normal
				<?php } ?>
			</select>
		</td>
	</tr>
		<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="tob_notas" rows="3" cols="30"><?php echo $row["tob_notas"] ?></textarea>
		</td>
	</tr>
	</table>
	<table border=1 cellpadding='10'>
	<caption>Tibia</caption>
	<tr>
		<th>
			Tipo (Tibia):
		</th>
		<td>
		<select name="tib_tipo">
				<?php if ($row["tib_tipo"] == "Varas") {?>
					<option value="">Seleccione un tipo...
					<option value="Varas" SELECTED>Varas
					<option value="Normal">Normal
				<?php } elseif ($row["tib_tipo"] == "Normal") {?>
					<option value="">Seleccione un tipo...
					<option value="Varas">Varas
					<option value="Normal" SELECTED>Normal
				<?php } else {?>
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Varas">Varas
					<option value="Normal">Normal
				<?php } ?>
			</select>
		</td>
	</tr>
		<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="tib_notas" rows="3" cols="30"><?php echo $row["tib_notas"] ?></textarea>
		</td>
	</tr>
	</table>
	</br>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php 
	else:	
	if ( isset($_POST['editsubmit'])) { // Accion de EDITAR
		$id = $_POST['nro_cita']; // Identificador del nro_cita que se va a editar.
		$tob_tipo = $_POST['tob_tipo'];
		$tob_notas = $_POST['tob_notas'];
		$tib_tipo = $_POST['tib_tipo'];
		$tib_notas = $_POST['tib_notas'];
		$sql = "UPDATE CITAS SET
				tob_tipo = '$tob_tipo',
				tob_notas = '$tob_notas',
				tib_tipo = '$tib_tipo',
				tib_notas = '$tib_notas'
				WHERE nro_cita='$id';";	
		
		if (@mysql_query($sql)) {
			echo('<p>Su cita ha sido Actualizada. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su cita: '.mysql_error().'</p>');
		}
	}
	if (isset($_GET['cit'])) 
	{   
		$cit = $_GET['cit'];
		$sql = "select nro_cita, nro_doc, tob_tipo, tob_notas, 
			tib_tipo, tib_notas from citas where nro_cita='$cit';";
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
		

		# Titulo Pagina
		echo "<h3>Podograma . Diagnostico . Tobillos y Tibias</strong> . 
		<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
		$pacapellido1 $pacapellido2 </a></h3><hr><br/>";
		
		# Vista Detalles
		#Tabla tobillos
		echo "<table border=1 cellpadding='10' width=375>\n";
		echo "<caption>Tobillos</caption>";
		printf("<tr><th width=125><b>Tipo (Tobillos):</b></th><td>%s</td></tr>", $row["tob_tipo"]);
		printf("<tr><th><b>Notas (Tobillos):</b></th><td>%s</td></tr>", $row["tob_notas"]);
		echo "</table>\n";
		echo "</br>\n";
		
		#Tabla tibias
		echo "<table border=1 cellpadding='10' width=375>\n";
		echo "<caption>Tibia</caption>";
		printf("<tr><th width=125><b>Tipo (Tibias):</th><td>%s</b></td></tr>", $row["tib_tipo"]);
		printf("<tr><th><b>Notas (Tibias):</b></th><td>%s</td></tr>", $row["tib_notas"]);
		echo "</table>\n";

		echo "</br>\n";
		printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n", 
			$_SERVER['PHP_SELF'], $row["nro_cita"]);
		printf("<a class='button' href=\"citas.php?num=$cit\">Volver</a>\n");
		echo "<br><br></br>\n";
	}
	endif;
	require("footer.php");
?>