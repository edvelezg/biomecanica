<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): #Editar
		$id = $_GET['id'];
		#sql 
		$sql = "select nro_cita, cad_desnivel, cad_lado, 
			cad_cantidad, cad_notas from citas where nro_cita='$id';";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
?>

<form action="cadera.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<h2> Cadera </h2>
	<table border=1 cellpadding='10'>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr>
		<th>
			Desnivel Pelvico:
		</th>
		<td>
			<?php if ($row["cad_desnivel"] == 1) { ?>
				<input type="checkbox" name="cad_desnivel" CHECKED>
			<?php } ?>
			<?php if ($row["cad_desnivel"] == 0) { ?>
				<input type="checkbox" name="cad_desnivel">
			<?php } ?>
		</td>
	</tr>
	<tr> 
		<th> 
			Lado:
		</th>
		<td>
			<select name="cad_lado">
			<?php if ($row["cad_lado"] == "Derecho") {?>
				<option value="">Seleccione un lado...
				<option value="Derecho" SELECTED>Derecho
				<option value="Izquierdo">Izquierdo
			<?php } elseif ($row["cad_lado"] == "Izquierdo") {?>
				<option value="">Seleccione un lado...
				<option value="Derecho">Derecho
				<option value="Izquierdo" SELECTED>Izquierdo
			<?php } else { ?>
				<option value="">Seleccione un lado...
				<option value="Derecho">Derecho
				<option value="Izquierdo">Izquierdo
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr> 
		<th> 
			Cantidad:
		</th>
		<td>
			<input type="text" name="cad_cantidad" value="<?php echo $row["cad_cantidad"] ?>"> mm.
		</td>
	</tr>
	<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="cad_notas" rows="3" cols="30"><?php echo $row["cad_notas"] ?></textarea>
		</td>
	</tr>
	</table>
	</br>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php 
else:	
	
	if ( isset($_POST['editsubmit'])) { #Editar
		$id = $_POST['nro_cita'];
		if ($_POST['cad_desnivel'] == 'on')
			$cad_desnivel = 1;
		else
			$cad_desnivel = 0;
		$cad_lado = $_POST['cad_lado'];
		$cad_cantidad = $_POST['cad_cantidad'];
		$cad_notas = $_POST['cad_notas'];		
		
		#sql
		$sql = "UPDATE citas SET
				cad_desnivel = '$cad_desnivel',
				cad_lado = '$cad_lado',
				cad_cantidad = '$cad_cantidad',
				cad_notas = '$cad_notas'
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
		$sql = "select nro_cita, nro_doc, cad_desnivel, cad_lado, 
			cad_cantidad, cad_notas from citas where nro_cita='$cit';";
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

		echo "<h3>Podograma . Diagnostico . Cadera . 
		<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
		$pacapellido1 $pacapellido2 </a></h3><hr/><br/>";
		
		#Vista Detalle
		echo "<table border=1 cellpadding='10' width=375>\n";
		if ($row["cad_desnivel"] == 0)
			printf("<tr><th><b>Desnivel de Cadera:</b></th><td>No</td></tr>");
		else
			printf("<tr><th><b>Desnivel de Cadera:</b></th><td>Si</td></tr>");			
		printf("<tr><th width=125><b>Lado:</b></th><td>%s</td></tr>", $row["cad_lado"]);
		printf("<tr><th><b>Cantidad:</b></th><td>%s</td></tr>", $row["cad_cantidad"]);
		printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["cad_notas"]);
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
					