<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>


<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): #case edit
		$id = $_GET['id'];
		$sql = "select nro_cita, plantillas, diagnostico, tamano, arcolong, 
			boton, cunas, taloneras, med_otro, tam_mod, arc_mod, bot_mod, 
			tal_mod, cun_mod from citas where nro_cita='$id';";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows($result);		
		$row = mysql_fetch_array($result);
?>

<!-- formulario editar -->
<form action="medidas.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<table border=1 cellpadding='10'>
	<caption>Diagnostico</caption>
	<tr>
		<th valign=top>
			Diagnostico:
		</th>
		<td>
			<textarea name="diagnostico" rows="2" cols="30"><?php echo $row["diagnostico"] ?></textarea>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Plantillas:
		</th>
		<td valign=top>
			<textarea name="plantillas" rows="2" cols="30"><?php echo $row["plantillas"] ?></textarea>
		</td>
	</tr>
	</table>
	<table border=1 cellpadding='10' width="700">
	<caption>Medidas</caption>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr>
		<th valign=top>
			Tamaño:
		</th>
		<td valign=top>
			<input type="text" name="tamano" value="<?php echo $row["tamano"] ?>"> 
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="tam_mod" rows="1" cols="30"><?php echo $row["tam_mod"] ?></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Arco Longitudinal:
		</th>
		<td valign=top>
			<input type="text" name="arcolong" value="<?php echo $row["arcolong"] ?>">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="arc_mod" rows="1" cols="30"><?php echo $row["arc_mod"] ?></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Boton Metatarsiano:
		</th>
		<td valign=top>
			<input type="text" name="boton" value="<?php echo $row["boton"] ?>">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="bot_mod" rows="1" cols="30"><?php echo $row["bot_mod"] ?></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Cuñas:
		</th>
		<td valign=top>
			<input type="text" name="cunas" value="<?php echo $row["cunas"] ?>">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="cun_mod" rows="1" cols="30"><?php echo $row["cun_mod"] ?></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Taloneras:
		</th>
		<td valign=top>
			<input type="text" name="taloneras" value="<?php echo $row["taloneras"] ?>">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="tal_mod" rows="1" cols="30"><?php echo $row["tal_mod"] ?></textarea>
		</td>
	</tr>
	<tr> 
		<th colspan=2 > 
			Otro:
		</th>
		<td colspan=2>
			<input type="otro" name="med_otro" value="<?php echo $row["med_otro"] ?>">
		</td>
	</tr>
	</table>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php 
else:
	if ( isset($_POST['editsubmit'])) { // Accion de EDITAR
		$id = $_POST['nro_cita']; // Identificador del nro_cita que se va a editar.
		$tamano = $_POST['tamano'];
		$arcolong = $_POST['arcolong'];
		$boton = $_POST['boton'];
		$cunas = $_POST['cunas'];
		$taloneras = $_POST['taloneras'];
		$med_otro = $_POST['med_otro'];
		$tam_mod = $_POST['tam_mod'];		
		$arc_mod = $_POST['arc_mod'];
		$bot_mod = $_POST['bot_mod'];
		$tal_mod = $_POST['tal_mod'];
		$cun_mod = $_POST['cun_mod'];
		$diagnostico = $_POST['diagnostico'];
		$plantillas = $_POST['plantillas'];
		$sql = "UPDATE citas SET
				tamano = '$tamano',
				arcolong = '$arcolong',
				boton = '$boton',
				cunas = '$cunas',
				taloneras = '$taloneras',
				med_otro = '$med_otro',
				tam_mod = '$tam_mod',
				arc_mod = '$arc_mod',
				bot_mod = '$bot_mod',
				tal_mod = '$tal_mod',
				cun_mod = '$cun_mod',
				plantillas = '$plantillas',
				diagnostico = '$diagnostico'
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
		#sql
		$sql = "select nro_cita, nro_doc, tamano, arcolong, boton, cunas, 
			taloneras, med_otro, tam_mod, arc_mod, bot_mod, plantillas, diagnostico, 
			tal_mod, cun_mod from citas where nro_cita='$cit';";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows($result);		
		
		#Obtener resultado de fila
		$row = mysql_fetch_array($result);
		
		#Obtener Paciente
		$nropac = $row["nro_doc"];
		$pacsql = "SELECT * FROM paciente WHERE nro_doc='$nropac'";
		$pacresult = mysql_query($pacsql);
		$pacrow = mysql_fetch_array($pacresult);
		$pacnombre = $pacrow["nombre"];
		$pacnombre2 = $pacrow["nombre2"];
		$pacapellido1 = $pacrow["apellido1"];
		$pacapellido2 = $pacrow["apellido2"];

		#Titulo Pagina
		echo "<h3>Prescripción . Plantillas . Medidas . 
		<a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2	
		$pacapellido1 $pacapellido2</a></h3><hr/><br/>";
		
		#Vista Detalles
		echo "<table border=1 cellpadding='10' width=600>\n";
		echo "<caption>Diagnostico</caption>\n";
		printf("<tr><th width=125><b>Diagnostico:</b></th><td colspan=3>%s</td>", $row["diagnostico"]);
		printf("<tr><th width=125><b>Plantillas:</b></th><td colspan=3>%s</td>", $row["plantillas"]);
		echo "</table>\n";
		
		echo "<table border=1 cellpadding='10'width=600>\n";
		echo "<caption>Medidas</caption>";
		printf("<tr><th width=130><b>Tamaño (Zapato):</b></th><td>%s</td>", $row["tamano"]);
		printf("<th width=125><b>Modificado:</b></th><td>%s</td></tr>", $row["tam_mod"]);
		printf("<tr><th><b>Arco Longitudinal:</b></th><td>%s</td>", $row["arcolong"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["arc_mod"]);
		printf("<tr><th><b>Boton Metatarsiano:</b></th><td>%s</td>", $row["boton"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["bot_mod"]);
		printf("<tr><th><b>Cuñas:</b></th><td>%s</td>", $row["cunas"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["cun_mod"]);
		printf("<tr><th><b>Taloneras:</b></th><td>%s</td>", $row["taloneras"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["tal_mod"]);
		printf("<tr><th colspan=2><b>Otro:</b></th><td colspan=2>%s</td></tr>", $row["med_otro"]);
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