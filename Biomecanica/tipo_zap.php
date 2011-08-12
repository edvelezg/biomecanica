<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): #accion editar
		$id = $_GET['id'];
		$sql = "select nro_cita, zap_tipo, zap_desc, 
			zap_alt, zap_punta from citas where nro_cita='$id';";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
?>

<form action="tipo_zap.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<h2> Tipo de Calzado Actual </h2>
	<table border=1 cellpadding='10'>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr>
		<th>
			Tipo de Calzado Actual:
		</th>
		<td>
		<select name="zap_tipo">
				<?php if ($row["zap_tipo"] == "Tenis") {?>
					<option value="">Seleccione un tipo...
					<option value="Tenis" SELECTED>Tenis
					<option value="Zapato de Calle">Zapato de Calle
					<option value="Zapato Especial">Zapato Especial
				<?php } elseif ($row["zap_tipo"] == "Zapato de Calle") {?>
					<option value="">Seleccione un tipo...
					<option value="Tenis">Tenis
					<option value="Zapato de Calle" SELECTED>Zapato de Calle
					<option value="Zapato Especial">Zapato Especial
				<?php } elseif ($row["zap_tipo"] == "Zapato Especial") {?>
					<option value="">Seleccione un tipo...
					<option value="Tenis">Tenis
					<option value="Zapato de Calle">Zapato de Calle
					<option value="Zapato Especial" SELECTED>Zapato Especial
				<?php } else {?>
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Tenis">Tenis
					<option value="Zapato de Calle">Zapato de Calle
					<option value="Zapato Especial">Zapato Especial
				<?php } ?>
			</select>
		</td>
	</tr>
		<tr>
		<th>
			Descripcion: 
		</th>
		<td>	
			<textarea name="zap_desc" rows="3" cols="30"><?php echo $row["zap_desc"] ?></textarea>
		</td>
	</tr>
	<tr> 
		<th> 
			Altura (Tacon):
		</th>
		<td>
			<input type="text" name="zap_alt" value="<?php echo $row["zap_alt"] ?>"> cm
		</td>
	</tr>
	<tr>
		<th>
			Punta: 
		</th>
		<td>	
			<select name="zap_punta">
			<?php if ($row["zap_punta"] == "Amplia") {?>
				<option value="">Seleccione un tipo...
				<option value="Amplia" SELECTED>Amplia
				<option value="Cerrada">Cerrada
			<?php } elseif ($row["zap_punta"] == "Cerrada") {?>
				<option value="">Seleccione un tipo...
				<option value="Amplia">Amplia
				<option value="Cerrada" SELECTED>Cerrada
			<?php } else {?>
				<option value="" SELECTED>Seleccione un tipo...
				<option value="Amplia">Amplia
				<option value="Cerrada">Cerrada
			<?php } ?>
			</select>
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
		$zap_tipo = $_POST['zap_tipo'];
		$zap_desc = $_POST['zap_desc'];
		$zap_alt = $_POST['zap_alt'];
		$zap_punta = $_POST['zap_punta'];
		$sql = "UPDATE citas SET
				zap_tipo = '$zap_tipo',
				zap_desc = '$zap_desc',
				zap_alt = '$zap_alt',
				zap_punta = '$zap_punta'
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
		$sql = "SELECT  nro_cita, nro_doc, zap_tipo, zap_desc, 
			zap_alt, zap_punta FROM citas WHERE nro_cita='$cit';";
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
		echo "<h3>Podograma . Diagnostico . Tipo de Zapato . </strong>
		<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
		$pacapellido1 $pacapellido2</a></h3><hr/><br/>";

		echo "<table border=1 cellpadding='10' width=375>\n";
		printf("<tr><th width=125><b>Tipo de Calzado Actual:</b></th><td>%s</td></tr>\n", $row["zap_tipo"]);
		printf("<tr><th><b>Descripcion:</b></th><td>%s</td></tr>\n", $row["zap_desc"]);
		printf("<tr><th><b>Altura (Tacon):</th><td>%s</b> cm</td></tr>\n", $row["zap_alt"]);
		printf("<tr><th><b>Punta:</b></th><td>%s</td></tr>\n", $row["zap_punta"]);
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