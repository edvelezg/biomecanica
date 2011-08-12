<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): #Accion Editar
		$id = $_GET['id'];
		#sql
		$sql = "SELECT nro_cita, mom_impresion, fecha, ocupacion, deporte, consulta, podograma, 
		foto, diagnostico, huellas, peso, doctor, institucion, citas.nro_doc, nombre, nombre2, apellido1, 
		apellido2 FROM citas, paciente WHERE nro_cita='$id' and citas.nro_doc = paciente.nro_doc";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$pacnombre = $row["nombre"];
		$pacnombre2 = $row["nombre2"];
		$pacapellido1 = $row["apellido1"];
		$pacapellido2 = $row["apellido2"];
?>

<!-- Formulario Edicion  -->
<form action="citas.php?num=<?php echo $row["nro_cita"] ?>" method="post">
	<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<input type="hidden" name="fecha_old" value="<?php echo $row["fecha"] ?>">
	<input type="hidden" name="mom_impresion_old" value="<?php echo $row["mom_impresion"] ?>">
	<?php
		echo ("<h2>Informacion General .:. $pacnombre 
		$pacnombre2 $pacapellido1 $pacapellido2 </h2><hr></br>");
		$hour = substr($row['mom_impresion'], 0, 2);
		$minutes = substr($row['mom_impresion'], 3, 2);
	?>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Momento de Impresion: 
		</th>
		<td colspan="7" align="left">
		    hora: <select name="hrs"> 
		    <?php
			   for($i = 0; $i < 24; $i++)
				if($hour == "$i")
		          echo "<option value='$i' SELECTED>". sprintf('%02d', $i) ."</option>\n";
				else
					echo "<option value='$i'>". sprintf('%02d', $i) ."</option>\n";
		    ?>
		    </select>
		    min: <select name="mins"> 
		    <?php
				$i = '00';
		        while($i < 60)
				{
					if($minutes == "$i")
			          echo "<option value='$i' SELECTED>". sprintf('%02d', $i) ."</option>\n";
					else
						echo "<option value='$i'>". sprintf('%02d', $i) ."</option>\n";
				   $i = $i + 15;
				}
		    ?>
		    </select>
	</tr>
	<tr> 
		<th> 
			Fecha: 
		</th>
		<td>
			<script type='text/JavaScript' src='scw.js'></script>
			<input name="fecha" onclick='scwShow(this,this); ' value=<?php echo $row["fecha"] ?> />
		</td>
	</tr>
	<tr>
		<th>
			Ocupacion: 
		</th>
		<td>
			<input type="text" name="ocupacion" size="40" value="<?php echo $row["ocupacion"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Deporte:
		</th>
		<td>
			<input type="text" name="deporte" size="40" value="<?php echo $row["deporte"] ?>">
		</td>
	</tr>
	<tr>
		<th valign=top>
			Consulta: 
		</th>
		<td>
			<textarea name="consulta" rows="3" cols="30"><?php echo $row["consulta"] ?></textarea>
		</td>
	</tr>
	<tr>
		<th>
			Peso:
		</th>
		<td>
			<input type="text" name="peso" value="<?php echo $row["peso"] ?>"> Kgs
		</td>
	</tr>
	<tr>
		<th>
			Medico Tratante: 
		</th>
		<td>
			<input type="text" name="doctor" value="<?php echo $row["doctor"] ?>">
		</td>
	</tr>
		<tr>
		<th>
			Institucion: 
		</th>
		<td>
			<input type="text" name="institucion" value="<?php echo $row["institucion"] ?>">
		</td>
	</tr>
	</table>
</br>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php	
	elseif ( isset($_GET['add']) && isset($_GET['doc']) ): #Adicion
		$doc = $_GET['doc'];
//  	$nropac = $row["nro_doc"];
		#sql
		$pacsql = "SELECT * FROM paciente WHERE nro_doc='$doc'";
		$pacresult = mysql_query($pacsql);
		$pacrow = mysql_fetch_array($pacresult);
		$pacnombre = $pacrow["nombre"];
		$pacnombre2 = $pacrow["nombre2"];
		$pacapellido1 = $pacrow["apellido1"];
		$pacapellido2 = $pacrow["apellido2"];
?>

<script language="JavaScript">
var currentLayer = 'page1';
function showLayer(lyr){
	hideLayer(currentLayer);
	document.getElementById(lyr).style.visibility = 'visible';
	currentLayer = lyr;
}

function hideLayer(lyr){
	document.getElementById(lyr).style.visibility = 'hidden';
}
function showValues(form){
	var values = '';
	var len = form.length - 1; //Leave off Submit Button
	for(i=0; i<len; i++){
		if(form[i].id.indexOf("C")!=-1||form[i].id.indexOf("B")!=-1)//Skip Continue and Back Buttons
			continue;
		values += form[i].id;
		values += ': ';
		values += form[i].value;
		values += '\n';
	}
	alert(values);
}
</script>
<style>
.page{
	position: absolute;
	top: 10px;
	visibility: hidden;
}
</style>
</head>

<!-- Formulario Adicion -->
<form method="post" action="citas.php">
<div id="page1" class="page" style="visibility:visible;">
	<?php
	echo ("<h2> Informacion General .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</h2><hr></br>");
		$hour = date("H");
		$minutes = date("i");
		if ($minutes >= 0 && $minutes < 15)
			$minutes = "00";
		if ($minutes >= 15 && $minutes < 30)
			$minutes = "30";
		else if ($minutes >= 30 && $minutes < 60)
			$hour = $hour + 1;
	?>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Numero de Documento:
		</th>
		<td>
			<?php echo $doc ?>
			<input type="hidden" name="nro_doc" value="<?php echo $doc ?>">
		</td>
	</tr>
	<tr>
		<th>
			Momento de Impresion: 
		</th>
		<td colspan="7" align="left">
		    hora: <select name="hrs"> 
		    <?php
			echo $tiempo = substr($row['mom_impresion'], 0, 2).substr($row['mom_impresion'], 3, 2);
			   for($i = 0; $i < 24; $i++)
				if($hour == "$i")
		          echo "<option value='$i' SELECTED>". sprintf('%02d', $i) ."</option>\n";
				else
					echo "<option value='$i'>". sprintf('%02d', $i) ."</option>\n";
		    ?>
		    </select>
		    min: <select name="mins"> 
		    <?php
				$i = '00';
		        while($i < 60)
				{
					if($minutes == "$i")
			          echo "<option value='$i' SELECTED>". sprintf('%02d', $i) ."</option>\n";
					else
						echo "<option value='$i'>". sprintf('%02d', $i) ."</option>\n";
				   $i = $i + 15;
				}
		    ?>
		    </select>
		</td>
	</tr>
	<tr> 
		<th> 
			Fecha: 
		</th>
		<td>
			<script type='text/JavaScript' src='scw.js'></script>
			<input name="fecha" onclick='scwShow(this,this);' onkeypress="return event.keyCode!=13" value=<?php echo date("Y-m-d"); ?> />
		</td>
	</tr>
	<tr>
		<th>
			Ocupacion: 
		</th>
		<td>
			<input type="text" name="ocupacion" size="40" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	<tr>
		<th>
			Deporte:
		</th>
		<td>
			<input type="text" name="deporte" size="40" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	<tr>
		<th valign=top>
			Consulta: 
		</th>
		<td>
			<textarea name="consulta" rows="3" cols="30"></textarea>
		</td>
	</tr>
	<tr>
		<th>
			Peso:
		</th>
		<td>
			<input type="text" name="peso" onkeypress="return event.keyCode!=13"> Kgs
		</td>
	</tr>
	<tr>
		<th>
			Medico Tratante: 
		</th>
		<td>
			<input type="text" name="doctor" size="40" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	<tr>
		<th>
			Institucion: 
		</th>
		<td>
			<input type="text" name="institucion" size="40" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	</table>
	<p><input type="button" id="C1" value="Continuar" onClick="showLayer('page2')"></p>
	</div>
	<div id="page2" class="page">
		<?php echo("<h2>Tipo de Zapato .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</h2><hr></br>"); ?>
		<table border=1 cellpadding='10'>
		<tr>
			<th>
				Tipo (Zapato):
			</th>
			<td>
			<select name="zap_tipo">
						<option value="" SELECTED>Seleccione un tipo...
						<option value="Tenis">Tenis
						<option value="Zapato de Calle">Zapato de Calle
						<option value="Zapato Especial">Zapato Especial
				</select>
			</td>
		</tr>
			<tr>
			<th>
				Descripcion: 
			</th>
			<td>	
				<textarea name="zap_desc" rows="3" cols="30"></textarea>
			</td>
		</tr>
		<tr> 
			<th> 
				Altura (Tacon):
			</th>
			<td>
				<input type="text" name="zap_alt" onkeypress="return event.keyCode!=13"> cm
			</td>
		</tr>
		<tr>
			<th>
				Punta: 
			</th>
			<td>	
				<select name="zap_punta">
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Amplia">Amplia
					<option value="Cerrada">Cerrada
				</select>
			</td>
		</tr>
		</table>
		<p><input type="button" id="B1" value="Atras" onClick="showLayer('page1')"><input type="button" id="C2" value="Continuar" onClick="showLayer('page3')"></p>
	</div>
	<div id="page3" class="page">
	<?php printf("<p><span class=normal><strong>Estado de Pie</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Huellas Iguales:
		</th>
		<td>
			<input type="checkbox" name="huellas" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	<tr>
		<th>
			Tipo de Pie:
		</th>
		<td>
			<select name="ep_tipo">
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Normal">Normal
					<option value="Plano">Plano
					<option value="Cavo">Cavo
			</select>
		</td>
	</tr>
	<tr> 
		<th> 
			Grado (Pies):
		</th>
		<td>
			<input type="text" name="ep_grado" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="ep_notas" rows="3" cols="30"></textarea>
		</td>
	</tr>
	</table>
	<p><input type="button" id="B2" value="Atras" onClick="showLayer('page2')"><input type="button" id="C3" value="Continuar" onClick="showLayer('page4')"></p>
	</div>
	<div id="page4" class="page">
	<?php printf("<p><span class=normal><strong>Artejos</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
	<tr> 
		<th> 
			Tipo
		</th>
		<td>
			<select name="art_tipo">
				<option value="" SELECTED>Seleccione un Tipo...
				<option value="Normal">Normal
				<option value="Martillo">Martillo
				<option value="Cuello de Cisne">Cuello de Cisne
				<option value="En Garra">En Garra
		</select>
		</td>
	</tr>
	<tr>
		<th>
			Lado (Hallux Valgus):
		</th>
		<td>
			<select name="art_lado">
				<option value="" SELECTED>Seleccione un lado...
				<option value="Derecho">Derecho
				<option value="Izquierdo">Izquierdo
				<option value="Bilateral">Bilateral
			</select>
		</td>
	</tr>
	<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="art_notas" rows="3" cols="30"></textarea>
		</td>
	</tr>
	</table>
	<p><input type="button" id="B3" value="Atras" onClick="showLayer('page3')"><input type="button" id="C4" value="Continuar" onClick="showLayer('page5')"></p>
	</div>
	<div id="page5" class="page">
	<?php printf("<p><span class=normal><strong>Antepies</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Tipo (Antepie):
		</th>
		<td>
			<select name="ant_tipo1">
				<option value="" SELECTED>Seleccione un tipo...
				<option value="Normal">Normal
				<option value="Adductus">Adductus
				<option value="Abductus">Abductus
			</select>
			
			<select name="ant_tipo2">
				<option value="" SELECTED>Seleccione...
				<option value="Supinado">Supinado
				<option value="Pronado">Pronado
			</select>
		</td>
	</tr>
	<tr> 
		<th> 
			Arco Transversal:
		</th>
		<td>
			<select name="arco_trans">
				<option value="" SELECTED>Seleccione...
				<option value="Caido">Caido
				<option value="Normal">Normal
			</select>
		</td>
	</tr>
	<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="ant_notas" rows="3" cols="30"></textarea>
		</td>
	</tr>
	</table>
	<p><input type="button" id="B4" value="Atras" onClick="showLayer('page4')"><input type="button" id="C5" value="Continuar" onClick="showLayer('page6')"></p>
	</div>
	<div id="page6" class="page">
	<?php printf("<p><span class=normal><strong>Tibias y Tobillos</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<caption>Tobillos</caption>
	<tr>
		<th>
			Tipo (Tobillos):
		</th>
		<td>
		<select name="tob_tipo">
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Valgo">Valgo
					<option value="Varo">Varo
					<option value="Normal">Normal
			</select>
		</td>
	</tr>
		<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="tob_notas" rows="3" cols="30"></textarea>
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
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Vara">Vara
					<option value="Normal">Normal
			</select>
		</td>
	</tr>
		<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="tib_notas" rows="3" cols="30"></textarea>
		</td>
	</tr>
	</table>
	<p><input type="button" id="B5" value="Atras" onClick="showLayer('page5')"><input type="button" id="C6" value="Continuar" onClick="showLayer('page7')"></p>
	</div>
	<div id="page7" class="page">
	<?php printf("<p><span class=normal><strong>Rodillas y Piel</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Tipo de Rodillas:
		</th>
		<td>
			<select name="rod_tipo">
					<option value="" SELECTED>Seleccione un tipo...
					<option value="Valgas">Valgas
					<option value="Varas">Varas
					<option value="Recurvatum">Recurvatum
					<option value="Normal">Normal
			</select>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Notas: 
		</th>
		<td>	
			<textarea name="rod_notas" rows="3" cols="30"></textarea>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Piel Callos : Nivel: 
		</th>
		<td>	
			<textarea name="piel_callos" rows="3" cols="30"></textarea>
		</td>
	</tr>	
	</table>
	<p><input type="button" id="B6" value="Atras" onClick="showLayer('page6')"><input type="button" id="C7" value="Continuar" onClick="showLayer('page8')"></p>
	</div>
	<div id="page8" class="page">
	<?php printf("<p><span class=normal><strong>Cadera</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Desnivel Pelvico:
		</th>
		<td>
			<input type="checkbox" name="cad_desnivel" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	<tr> 
		<th> 
			Lado:
		</th>
		<td>
			<select name="cad_lado">
				<option value="" SELECTED>Seleccione un lado...
				<option value="Derecho">Derecho
				<option value="Izquierdo">Izquierdo
			</select>
		</td>
	</tr>
	<tr> 
		<th> 
			Cantidad:
		</th>
		<td>
			<input type="text" name="cad_cantidad" onkeypress="return event.keyCode!=13"> mm.
		</td>
	</tr>
	<tr>
		<th>
			Notas: 
		</th>
		<td>	
			<textarea name="cad_notas" rows="3" cols="30"></textarea>
		</td>
	</tr>
	</table>
	<p><input type="button" id="B7" value="Atras" onClick="showLayer('page7')"><input type="button" id="C8" value="Continuar" onClick="showLayer('page9')"></p>
	</div>
	<div id="page9" class="page">
	<?php printf("<p><span class=normal><strong>Columna</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
		<table border=1 cellpadding='10'>
		<tr>
			<th>
				Escoliosis:
			</th>
			<td>
				<input type="checkbox" name="escoliosis" onkeypress="return event.keyCode!=13">
			</td>
			<th>
				Lado:
			</th>
			<td>
				<select name="esco_lado">
					<option value="" SELECTED>Seleccione...
					<option value="Derecho">Derecho
					<option value="Izquierdo">Izquierdo
				</select>
			</td>
		</tr>
		<tr> 
			<th> 
				Cifosis:
			</th>
			<td>
				<input type="checkbox" name="cifosis" onkeypress="return event.keyCode!=13">
			</td>
			<th> 
				Hiperlordosis:
			</th>
			<td>
				<input type="checkbox" name="hiperlordosis" onkeypress="return event.keyCode!=13">
			</td>
		</tr>
		<tr>
			<tr> 
			<th colspan=2 valign=top> 
				Otros:
			</th>
			<td colspan=2>
				<textarea name="col_otro" rows="3" cols="30"></textarea>
			</td>
		</tr>
		<tr>
			<th colspan=2 valign=top>
				Notas: 
			</th>
			<td colspan=2>	
				<textarea name="col_notas" rows="3" cols="30"></textarea>
			</td>
		</tr>
		</table>
		<p><input type="button" id="B8" value="Atras" onClick="showLayer('page8')"><input type="button" id="C9" value="Continuar" onClick="showLayer('page10')"></p>
	</div>
	<div id="page10" class="page">
	<?php printf("<p><span class=normal><strong>Diagnostico y Medidas</strong> .:. $pacnombre 
	$pacnombre2 $pacapellido1 $pacapellido2</span></p><hr></br>"); ?>
	<table border=1 cellpadding='10'>
	<caption>Diagnostico</caption>
	<tr>
		<th valign=top>
			Diagnostico:
		</th>
		<td>
			<textarea name="diagnostico" rows="2" cols="30"></textarea>
		</td>
	</tr>
	<tr>
		<th valign=top>
			Plantillas:
		</th>
		<td valign=top>
			<textarea name="plantillas" rows="2" cols="30"></textarea>
		</td>
	</tr>
	</table>
	<table border=1 cellpadding='10'>	
	<caption>Medidas</caption>
	<tr>
		<th valign=top>
			Tamaño:
		</th>
		<td valign=top>
			<input type="text" name="tamano" onkeypress="return event.keyCode!=13"> 
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="tam_mod" rows="1" cols="30"></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Arco Longitudinal:
		</th>
		<td valign=top>
			<input type="text" name="arcolong" onkeypress="return event.keyCode!=13">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="arc_mod" rows="1" cols="30"></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Boton Metatarsiano:
		</th>
		<td valign=top>
			<input type="text" name="boton" onkeypress="return event.keyCode!=13">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="bot_mod" rows="1" cols="30"></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Cuñas:
		</th>
		<td valign=top>
			<input type="text" name="cunas" onkeypress="return event.keyCode!=13">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="cun_mod" rows="1" cols="30"></textarea>
		</td>
	</tr>
	<tr> 
		<th valign=top> 
			Taloneras:
		</th>
		<td valign=top>
			<input type="text" name="taloneras" onkeypress="return event.keyCode!=13">
		</td>
		<th valign=top>
			Modificado:
		</th>
		<td>
			<textarea name="tal_mod" rows="1" cols="30"></textarea>
		</td>
	</tr>
	<tr> 
		<th colspan=2 > 
			Otro:
		</th>
		<td colspan=2>
			<input type="text" name="med_otro" onkeypress="return event.keyCode!=13">
		</td>
	</tr>
	</table>
	<p><input type="button" id="B9" value="Atras" onClick="showLayer('page9')">
		<input type="submit" value="Crear Cita" name="addsubmit"></p>
	</div>
</form>

<?php

else: #Default Page
	
	if ( isset($_POST['addsubmit'])) { #Accion Agregar
		
		#debug
		/*echo '<pre>';
		echo print_r($_POST);
		echo '</pre>'; */
		
		# Recolectar Informacion de Formulario
		$mom_impresion = $_POST['hrs'].":".$_POST['mins'];
		$fecha = $_POST['fecha'];
		$ocupacion = $_POST['ocupacion'];
		$deporte = $_POST['deporte'];
		$consulta = $_POST['consulta'];
		$ep_tipo = $_POST['ep_tipo'];
		$ep_grado = $_POST['ep_grado'];
		$ep_notas = $_POST['ep_notas'];
		if ($_POST['huellas'] == 'on')
			$huellas = 1;
		else
			$huellas = 0;
		$peso = $_POST['peso'];
		$doctor = strtolower($_POST['doctor']);
		$institucion = $_POST['institucion'];
		$nro_doc = $_POST['nro_doc'];
		$art_tipo = $_POST['art_tipo'];
		$art_lado = $_POST['art_lado'];
		$art_notas = $_POST['art_notas'];
		$ant_tipo1 = $_POST['ant_tipo1'];
		$ant_tipo2 = $_POST['ant_tipo2'];
		$arco_trans = $_POST['arco_trans'];
		$ant_notas = $_POST['ant_notas'];	
		$tob_tipo = $_POST['tob_tipo'];
		$tob_notas = $_POST['tob_notas'];
		$tib_tipo = $_POST['tib_tipo'];
		$tib_notas = $_POST['tib_notas'];
		$rod_tipo = $_POST['rod_tipo'];
		$rod_notas = $_POST['rod_notas'];
		$piel_callos = $_POST['piel_callos'];
		if ($_POST['cad_desnivel'] == 'on')
			$cad_desnivel = 1;
		else
			$cad_desnivel = 0;
		$cad_lado = $_POST['cad_lado'];
		$cad_cantidad = $_POST['cad_cantidad'];
		$cad_notas = $_POST['cad_notas'];
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
		$zap_tipo = $_POST['zap_tipo'];
		$zap_desc = $_POST['zap_desc'];
		$zap_alt = $_POST['zap_alt'];
		$zap_punta = $_POST['zap_punta'];	
		$diagnostico = $_POST['diagnostico'];
		$plantillas = $_POST['plantillas'];
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
		
		if (!trim($doctor) == "")
		{
			# Verifica la existencia del medico
			$existsSql = "SELECT * FROM medicos WHERE nombre=
				'$doctor'";
			$existsRes = mysql_query($existsSql);
			$numrows = mysql_num_rows($existsRes); 
			
			if ($numrows == 1) #Si ya existe.
			{
				echo('<p>Cita adicionada al medico existente. </p>');
			}
			
			else #Si no existe
			{
				
				#sql
				$sql = "insert into medicos SET
						nombre='$doctor',
						institucion='$institucion'";
				
				if (@mysql_query($sql)) {
					echo('<p>Se ha creado el medico para su cita. </p>');
				} else {
					echo ('<p>Ocurrio un Error al ingresar su medico: '.mysql_error().'</p>');
				}
				
			}
		}
		
		# Verifica la existencia de la cita.
		$existsSql = "SELECT * FROM citas
		WHERE fecha='$fecha' and mom_impresion = '$mom_impresion'";
		$existsRes = mysql_query($existsSql);
		$numrows = mysql_num_rows($existsRes);
		if ($numrows == 1) { // La cita ya existe
			$ERRORS[] = "La cita con fecha ". $fecha . " y momento de impresion ". $mom_impresion. " ya existe." ;
		}
		
		# Verifica que la fecha sea valida
		if (!checkdate(substr($fecha, 5, 2), substr($fecha, 8, 2), substr($fecha, 0, 4)))
		{
			$ERRORS[] = "La fecha que ingreso no es una fecha valida";
		} 
		
		#Display Errors
		if(sizeof($ERRORS) > 0)
		{
			echo "<h2>Se encontraron los siguientes errores: </h2>\n";
			// format and display error list
			echo "<ul>";
			foreach ($ERRORS as $e)
			{
				echo "<li>$e</li>";
			}
			echo "<br><br></br>";
			require("footer.php");
			exit;
		}
		
		#sql
		$sql = "insert into citas set
			mom_impresion='$mom_impresion',
			fecha='$fecha',
			ocupacion='$ocupacion',
			deporte='$deporte',
			consulta='$consulta',
			huellas='$huellas',
			peso='$peso',
			nro_doc='$nro_doc',
			doctor='$doctor',
			institucion='$institucion',
			ep_tipo = '$ep_tipo',
			ep_grado = '$ep_grado',
			ep_notas = '$ep_notas',
			art_tipo = '$art_tipo',
			art_lado = '$art_lado',
			art_notas = '$art_notas',
			ant_tipo1 = '$ant_tipo1',
			ant_tipo2 = '$ant_tipo2',
			arco_trans = '$arco_trans',
			ant_notas = '$ant_notas',
			tob_tipo = '$tob_tipo',
			tob_notas = '$tob_notas',
			tib_tipo = '$tib_tipo',
			tib_notas = '$tib_notas',
			rod_tipo = '$rod_tipo',
			rod_notas = '$rod_notas',
			piel_callos = '$piel_callos',
			cad_desnivel = '$cad_desnivel',
			cad_lado = '$cad_lado',
			cad_cantidad = '$cad_cantidad',
			cad_notas = '$cad_notas',
			escoliosis = '$escoliosis',
			esco_lado = '$esco_lado',
			cifosis = '$cifosis',
			hiperlordosis = '$hiperlordosis',
			col_otro = '$col_otro',
			col_notas = '$col_notas',
			zap_tipo = '$zap_tipo',
			zap_desc = '$zap_desc',
			zap_alt = '$zap_alt',
			zap_punta = '$zap_punta',
			diagnostico = '$diagnostico',
			plantillas = '$plantillas',
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
			cun_mod = '$cun_mod'";
			
		if (@mysql_query($sql)) {
			echo('<p>Su cita ha sido ingresada. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su cita: '.mysql_error().'</p>');
		}
	}
	
	if ( isset($_POST['editsubmit'])) { # Accion Editar
		$id = $_POST['nro_cita'];
		$fecha_old = $_POST['fecha_old'];
		$mom_impresion_old = $_POST['mom_impresion_old'];
		$mom_impresion = $_POST['hrs'].":".$_POST['mins'].":00";
		$fecha = $_POST['fecha'];
		$ocupacion = $_POST['ocupacion'];
		$deporte = $_POST['deporte'];
		$consulta = $_POST['consulta'];
		$diagnostico = $_POST['diagnostico'];
		$peso = $_POST['peso'];
		$doctor = strtolower($_POST['doctor']);
		$institucion = $_POST['institucion'];

		# Verifica la existencia de la cita.
		if (($fecha == $fecha_old) && ($mom_impresion == $mom_impresion_old)) { // No hay que revisar
		} else {
			$existsSql = "SELECT * FROM citas
			WHERE fecha='$fecha' and mom_impresion = '$mom_impresion'";
			$existsRes = mysql_query($existsSql);
			$numrows = mysql_num_rows($existsRes);
			if ($numrows == 1) { // La cita ya existe
				$ERRORS[] = "La cita con fecha ". $fecha . " y momento de impresion ". $mom_impresion . " ya existe." ;
			}
		}
		
		# Verifica que la fecha sea valida
		if (!checkdate(substr($fecha, 5, 2), substr($fecha, 8, 2), substr($fecha, 0, 4)))
		{
			$ERRORS[] = "La fecha que ingreso no es una fecha valida";
		} 
		
		#Display Errors
		if(sizeof($ERRORS) > 0)
		{
			echo "<h2>Se encontraron los siguientes errores: </h2>\n";
			// format and display error list
			echo "<ul>";
			foreach ($ERRORS as $e)
			{
				echo "<li>$e</li>";
			}
			echo "<br><br></br>";
			require("footer.php");
			exit;
		}
		
		# Verifica la existencia del medico
		$existsSql = "SELECT * FROM medicos WHERE nombre=
			'$doctor'";
		$existsRes = mysql_query($existsSql);
		$numrows = mysql_num_rows($existsRes); 
		
		if (!trim($doctor) == "")
		{
			if ($numrows == 1) #Si ya existe.
			{
			
			}
			
			else #Si no existe
			{
				
				#sql
				$sql = "insert into medicos SET
						nombre='$doctor',
						institucion='$institucion'";
				
				if (@mysql_query($sql)) {
					echo('<p>Se ha creado el medico para su cita. </p>');
				} else {
					echo ('<p>Ocurrio un Error al ingresar su medico: '.mysql_error().'</p>');
				}
				
			}
		}

		#sql
		$sql = "update citas SET
		mom_impresion='$mom_impresion',
		fecha='$fecha',
		ocupacion='$ocupacion',
		deporte='$deporte',
		consulta='$consulta',
		peso='$peso',
		doctor='$doctor',
		institucion='$institucion'
		WHERE nro_cita='$id'";		
		
		if (@mysql_query($sql)) {
			echo('<p>Su cita ha sido Actualizada. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su cita: '.mysql_error().'</p>');
		}
	}
	
	# Vista Detalles.
	if (isset($_GET['num'])) 
	{   
		$num = $_GET['num'];
		#sql
		$sql = "SELECT nro_cita, mom_impresion, fecha, ocupacion, deporte, consulta, podograma, 
			foto, diagnostico, huellas, peso, doctor, institucion, nro_doc FROM citas WHERE nro_cita='$num'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
				
		$nropac = $row["nro_doc"];
		$pacsql = "SELECT * FROM paciente WHERE nro_doc='$nropac'";
		$pacresult = mysql_query($pacsql);
		$pacrow = mysql_fetch_array($pacresult);
		$pacnombre = $pacrow["nombre"];
		$pacnombre2 = $pacrow["nombre2"];
		$pacapellido1 = $pacrow["apellido1"];
		$pacapellido2 = $pacrow["apellido2"];
		
		#Titulo Pagina
		echo "<h2>Informacion General . <a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2
		 $pacapellido1 $pacapellido2 </a></h2><hr/><br/>";
		
		# table menu
		echo "<table class='navright' border=0 cellpadding='5' width=180 height=150>\n";
		printf("<tr class='head'><td><a href=\"tipo_zap.php?cit=$num\">Ver Tipo de Zapato</a></td></tr>");
		printf("<tr class='head'><td><a href=\"estadopies.php?cit=$num\">Estado de Pies</a></td></tr>");
		printf("<tr class='head'><td><a href=\"artejos.php?cit=$num\">Ver Artejos</a></td></tr>");
		printf("<tr class='head'><td><a href=\"antepies.php?cit=$num\">Ver Antepies</a></td></tr>");
		printf("<tr class='head'><td><a href=\"tibia.php?cit=$num\">Ver Tobillos y Tibias</a></td></tr>");
		printf("<tr class='head'><td><a href=\"rodillas.php?cit=$num\">Ver Rodillas y Piel</a></td></tr>");
		printf("<tr class='head'><td><a href=\"cadera.php?cit=$num\">Ver Cadera</a></td></tr>");
		printf("<tr class='head'><td><a href=\"columna.php?cit=$num\">Ver Columna</a></td></tr>");
		printf("<tr class='head'><td><a href=\"medidas.php?cit=$num\">Ver Medidas</a></td></tr></tr>");
		echo "</table>";
		
		#Vista Detalles
		echo "<table border=1 cellpadding='10' width=500>\n";
		printf("<tr><th width=160><b>Momento de Impresion:</b></th><td>%s</td></tr>", 
		$row["mom_impresion"]);
		printf("<tr><th><b>Fecha:</td><td>%s</b></th></tr>", $row["fecha"]);
		printf("<tr><th><b>Ocupacion:</b></th><td>%s</td></tr>", $row["ocupacion"]);
		printf("<tr><th><b>Deporte:</b></th><td>%s</td></tr>", $row["deporte"]);
		printf("<tr><th><b>Consulta:</b></th><td>%s</td></tr>", $row["consulta"]);
		printf("<tr><th><b>Podograma:</b></th><td><a href=\"podograma.php?id=%s\">%s</a>
		</td></tr>", $row["podograma"], $row["podograma"]); // link para el podograma
		printf("<tr><th><b>Foto:</b></th><td><a href=\"foto.php?id=%s\">%s</a>
		</td></tr>", $row["foto"], $row["foto"]); // link para imagen de la foto	
		printf("<tr><th><b>Peso:</b></th><td>%s kg</td></tr>", $row["peso"]);
		printf("<tr><th><b>Medico Tratante:</b></th><td><a href=\"medicos.php?nom=%s\">%s</a>
		</td></tr>", $row["doctor"], ucwords($row["doctor"]));
		printf("<tr><th><b>Institucion:</b></th><td>". $row['institucion'] . "</td></tr>");
		echo "</table>\n";
		echo "</br>\n";
		printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n", 
			$_SERVER['PHP_SELF'], $row["nro_cita"]);
		printf("<a class='button' href=\"reporte.php?num=%s\">Reporte</a>\n", $row["nro_cita"]);
		printf("<a class='button' href=\"uploader.php?id=%s\">Subir Imagenes</a>\n", $row["nro_cita"]);
		echo "<br><br></br>\n";
	}
	
	#Citas sin Imagenes
	else if (isset($_GET['sinimg'])) 
	{
		// how many rows to show per page
		$rowsPerPage = 5;
		// by default we show first page
		$pageNum = 1;
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
			$pageNum = $_GET['page'];
		}
		// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;
		$query = "SELECT nombre, nombre2, apellido1, apellido2 , fecha, mom_impresion, nro_cita,
			consulta, doctor FROM citas, paciente WHERE paciente.nro_doc = citas.nro_doc and 
			(citas.podograma = '' or citas.foto='') ORDER BY fecha desc ";			   
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		
		#Vista Gral
		echo "<h1> Citas Sin Imagenes</h1><hr/><br/>";
		echo "<table border=1 cellpadding='10' width=600>\n";
		echo "<tr align=center><th><b>Nombre del Paciente</b></t><th><b>Fecha</b></th><th><b>Momento de" .
		" Impresion</b></th><th><b>Medico</b></th></tr>\n";
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td><a href=\"%s?num=%s\">%s %s %s %s</a></td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $_SERVER['PHP_SELF'],
			$row["nro_cita"], $row["nombre"], $row["nombre2"], $row["apellido1"], $row["apellido2"], $row["fecha"], $row["mom_impresion"], ucwords($row["doctor"]));
		}
		echo "</table>\n";
		if ($numrows == 0) // Condicion para revisar si no hay Citas
		{
			echo "<h2> No hay Citas </h2>";
		}
		echo "<br>";
		// how many rows we have in database
		$result  = mysql_query($query) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		// how many pages we have when using paging?
		$maxPage = ceil($numrows/$rowsPerPage);
		$self = $_SERVER['PHP_SELF'];
		// creating 'previous' and 'next' link
		// plus 'first page' and 'last page' link

		// print 'previous' link only if we're not
		// on page one
		if ($pageNum > 1)
		{
			$page = $pageNum - 1;
			$prev = " <a href=\"$self?sinimg=1&page=$page\">[Anterior]</a> ";

			$first = " <a href=\"$self?sinimg=1&page=1\">[Primera Pagina]</a> ";
		}
		else
		{
			$prev  = ' [Anterior] ';       // we're on page one, don't enable 'previous' link
			$first = ' [Primera Pagina] '; // nor 'first page' link
		}
		// print 'next' link only if we're not
		// on the last page
		if ($pageNum < $maxPage)
		{
			$page = $pageNum + 1;
			$next = " <a href=\"$self?sinimg=1&page=$page\">[Siguiente]</a> ";

			$last = " <a href=\"$self?sinimg=1&page=$maxPage\">[Ultima Pagina]</a> ";
		}
		else
		{
			$next = ' [Siguiente] ';      // we're on the last page, don't enable 'next' link
			$last = ' [Ultima Pagina] '; // nor 'last page' link
		}
		// print the page navigation link
		echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> ". 			"Paginas " . $next . $last;
		echo '<br><br>';
		printf("<a class='button' href=\"buscit.php\">Buscar Cita</a>");
		printf("<a class='button' href=\"citas.php\">Citas de Hoy</a>");
		printf("<a class='button' href=\"citas.php?sinimg='1'\">Citas sin Imagenes</a>");
		echo '<br><br></br>';
	}
	
	#Citas de Ayer
	else if (isset($_GET['ayer'])) 
	{
		// how many rows to show per page
		$rowsPerPage = 5;
		// by default we show first page
		$pageNum = 1;
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
			$pageNum = $_GET['page'];
		}
		// counting the offset
		$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))); 
		$offset = ($pageNum - 1) * $rowsPerPage;
		$query = "SELECT nombre, nombre2, apellido1, apellido2 , fecha, mom_impresion, nro_cita,
			consulta, doctor FROM citas, paciente WHERE paciente.nro_doc = citas.nro_doc and citas.fecha = '$yesterday' ORDER BY fecha desc ";			   
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		
		#Vista Gral
		echo "<h1> Citas de Ayer</h1><hr/><br/>";
		echo "<table border=1 cellpadding='10' width=600>\n";
		echo "<tr align=center><th><b>Nombre del Paciente</b></t><th><b>Fecha</b></th><th><b>Momento de" .
		" Impresion</b></th><th><b>Medico</b></th></tr>\n";
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td><a href=\"%s?num=%s\">%s %s %s %s</a></td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $_SERVER['PHP_SELF'],
			$row["nro_cita"], $row["nombre"], $row["nombre2"], $row["apellido1"], $row["apellido2"], $row["fecha"], $row["mom_impresion"], ucwords($row["doctor"]));
		}
		echo "</table>\n";
		if ($numrows == 0) // Condicion para revisar si no hay Citas
		{
			echo "<h2> No hay Citas </h2>";
		}
		echo "<br>";
		// how many rows we have in database
		$result  = mysql_query($query) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		// how many pages we have when using paging?
		$maxPage = ceil($numrows/$rowsPerPage);
		$self = $_SERVER['PHP_SELF'];
		// creating 'previous' and 'next' link
		// plus 'first page' and 'last page' link

		// print 'previous' link only if we're not
		// on page one
		if ($pageNum > 1)
		{
			$page = $pageNum - 1;
			$prev = " <a href=\"$self?ayer=1&page=$page\">[Anterior]</a> ";

			$first = " <a href=\"$self?ayer=1&page=1\">[Primera Pagina]</a> ";
		}
		else
		{
			$prev  = ' [Anterior] ';       // we're on page one, don't enable 'previous' link
			$first = ' [Primera Pagina] '; // nor 'first page' link
		}
		// print 'next' link only if we're not
		// on the last page
		if ($pageNum < $maxPage)
		{
			$page = $pageNum + 1;
			$next = " <a href=\"$self?ayer=1&page=$page\">[Siguiente]</a> ";

			$last = " <a href=\"$self?ayer=1&page=$maxPage\">[Ultima Pagina]</a> ";
		}
		else
		{
			$next = ' [Siguiente] ';      // we're on the last page, don't enable 'next' link
			$last = ' [Ultima Pagina] '; // nor 'last page' link
		}
		// print the page navigation link
		echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> ". 			"Paginas " . $next . $last;
		echo '<br><br>';
		printf("<a class='button' href=\"buscit.php\">Buscar Cita</a>");
		printf("<a class='button' href=\"citas.php\">Citas de Hoy</a>");
		printf("<a class='button' href=\"citas.php?sinimg='1'\">Citas sin Imagenes</a>");
		echo '<br><br></br>';
		
	}
	else // Mostrar el listado de Citas
	{
		// how many rows to show per page
		$rowsPerPage = 5;
		// by default we show first page
		$pageNum = 1;
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
			$pageNum = $_GET['page'];
		}
		// counting the offset
		$date = date("Y-m-d"); 
		$offset = ($pageNum - 1) * $rowsPerPage;
		$query = "SELECT nombre, nombre2, apellido1, apellido2 , fecha, mom_impresion, nro_cita,
			consulta, doctor FROM citas, paciente WHERE paciente.nro_doc = citas.nro_doc and citas.fecha = '$date' ORDER BY fecha desc ";			   
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		
		#Vista Gral
		echo "<h1> Citas de Hoy</h1><hr/><br/>";
		echo "<table border=1 cellpadding='10' width=600>\n";
		echo "<tr align=center><th><b>Nombre del Paciente</b></t><th><b>Fecha</b></th><th><b>Momento de" .
		" Impresion</b></th><th><b>Medico</b></th></tr>\n";
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td><a href=\"%s?num=%s\">%s %s %s %s</a></td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $_SERVER['PHP_SELF'],
			$row["nro_cita"], $row["nombre"], $row["nombre2"], $row["apellido1"], $row["apellido2"], $row["fecha"], $row["mom_impresion"], ucwords($row["doctor"]));
		}
		echo "</table>\n";
		if ($numrows == 0) // Condicion para revisar si no hay Citas
		{
			echo "<h2> No hay Citas </h2>";
		}
		echo "<br>";
		// how many rows we have in database
		$result  = mysql_query($query) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		// how many pages we have when using paging?
		$maxPage = ceil($numrows/$rowsPerPage);
		$self = $_SERVER['PHP_SELF'];
		// creating 'previous' and 'next' link
		// plus 'first page' and 'last page' link

		// print 'previous' link only if we're not
		// on page one
		if ($pageNum > 1)
		{
			$page = $pageNum - 1;
			$prev = " <a href=\"$self?page=$page\">[Anterior]</a> ";

			$first = " <a href=\"$self?page=1\">[Primera Pagina]</a> ";
		}
		else
		{
			$prev  = ' [Anterior] ';       // we're on page one, don't enable 'previous' link
			$first = ' [Primera Pagina] '; // nor 'first page' link
		}
		// print 'next' link only if we're not
		// on the last page
		if ($pageNum < $maxPage)
		{
			$page = $pageNum + 1;
			$next = " <a href=\"$self?page=$page\">[Siguiente]</a> ";

			$last = " <a href=\"$self?page=$maxPage\">[Ultima Pagina]</a> ";
		}
		else
		{
			$next = ' [Siguiente] ';      // we're on the last page, don't enable 'next' link
			$last = ' [Ultima Pagina] '; // nor 'last page' link
		}
		// print the page navigation link
		echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> ". 			"Paginas " . $next . $last;
		echo '<br><br>';
		printf("<a class='button' href=\"buscit.php\">Buscar Cita</a>");
		printf("<a class='button' href=\"citas.php?ayer='1'\">Citas de Ayer</a>");
		printf("<a class='button' href=\"citas.php?sinimg='1'\">Citas sin Imagenes</a>");
		echo '<br><br></br>';
	}	
	require "footer.php";
	endif;
?>
					