<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): // PARA EDITAR UNA CITA
		$id = $_GET['id'];
		$sql = "select nro_cita, escoliosis, esco_lado, cifosis, hiperlordosis, 
			col_otro, col_notas from citas where nro_cita='$id';";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
?>

<form action="columna.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<h2> Columna </h2>
	<table border=1 cellpadding='10'>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr>
		<th>
			<label for="escoliosis">Escoliosis:</label>
		</th>
		<td>
			<?php if ($row["escoliosis"] == 1) { ?>
				<input type="checkbox" id="escoliosis" name="escoliosis" CHECKED>
			<?php } ?>
			<?php if ($row["escoliosis"] == 0) { ?>
				<input type="checkbox" id="escoliosis" name="escoliosis">
			<?php } ?>
		</td>
	<tr>
		<th>
			Lado:
		</th>
		<td>
			<select name="esco_lado">
				<?php if ($row["esco_lado"] == "Izquierdo") {?>
					<option value="">Seleccione...
					<option value="Derecho">Derecho
					<option value="Izquierdo" SELECTED>Izquierdo
				<?php } elseif ($row["esco_lado"] == "Derecho") {?>
					<option value="">Seleccione...
					<option value="Derecho" SELECTED>Derecho
					<option value="Izquierdo">Izquierdo
				<?php } else {?>
					<option value="" SELECTED>Seleccione...
					<option value="Derecho">Derecho
					<option value="Izquierdo">Izquierdo
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr> 
		<th> 
			Cifosis:
		</th>
		<td>
			<?php if ($row["cifosis"] == 1) { ?>
				<input type="checkbox" name="cifosis" CHECKED>
			<?php } ?>
			<?php if ($row["cifosis"] == 0) { ?>
				<input type="checkbox" name="cifosis">
			<?php } ?>
		</td>
	</tr>
	<tr> 
		<th> 
			Hiperlordosis:
		</th>
		<td>
			<?php if ($row["hiperlordosis"] == 1) { ?>
				<input type="checkbox" name="hiperlordosis" CHECKED>
			<?php } ?>
			<?php if ($row["hiperlordosis"] == 0) { ?>
				<input type="checkbox" name="hiperlordosis">
			<?php } ?>
		</td>
	</tr>
	<tr>
		<tr> 
		<th valign=top> 
			Otros:
		</th>
		<td colspan=2>
			<textarea name="col_otro" rows="3" cols="30"><?php echo $row["col_otro"] ?></textarea>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Notas: 
		</th>
		<td>
			<textarea name="col_notas" rows="3" cols="30"><?php echo $row["col_notas"] ?></textarea>
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
		if ($_POST['escoliosis'] == 'on')
			$escoliosis = 1;
		else
			$escoliosis = 0;
		$esco_lado = $_POST['esco_lado'];
		if ($_POST['cifosis'] == 'on')
			$cifosis = 1;
		else
			$cifosis = 0;
		if ($_POST['hiperlordosis'] == 'on')
			$hiperlordosis = 1;
		else
			$hiperlordosis = 0;
		$col_otro = $_POST['col_otro'];
		$col_notas = $_POST['col_notas'];
		$sql = "UPDATE citas SET
				escoliosis = '$escoliosis',
				esco_lado = '$esco_lado',
				cifosis = '$cifosis',
				hiperlordosis = '$hiperlordosis',
				col_otro = '$col_otro',
				col_notas = '$col_notas'
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
		$sql = "select nro_cita, nro_doc, escoliosis, esco_lado, cifosis, hiperlordosis, 
			col_otro, col_notas from citas where nro_cita='$cit';";
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
	
		#Titulo Tabla
		echo "<h3>Podograma . Diagnostico . Estado de Columna . 
		<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
		$pacapellido1 $pacapellido2</a></h3><hr/><br/>";
		
		#Vista Detalles
		echo "<table border=1 cellpadding='10' width=375>\n";
		if ($row["escoliosis"] == 0)
			printf("<tr><th width=125><b>Escoliosis:</b></th><td>No</td></tr>");
		else
			printf("<tr><th><b>Escoliosis:</b></th><td>Si</td></tr>");
		printf("<tr><th><b>Lado:</b></th><td>%s</td></tr>", $row["esco_lado"]);
		if ($row["cifosis"] == 0)
			printf("<tr><th><b>Cifosis:</b></th><td>No</td></tr>");
		else
			printf("<tr><th><b>Cifosis:</b></th><td>Si</td></tr>");		
		if ($row["hiperlordosis"] == 0)
			printf("<tr><th><b>Hiperlordosis:</b></th><td>No</td></tr>");
		else
			printf("<tr><th><b>Hiperlordosis:</b></th><td>Si</td></tr>");
		printf("<tr><th><b>Otro:</b></th><td>%s</td></tr>", $row["col_otro"]);
		printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["col_notas"]);
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