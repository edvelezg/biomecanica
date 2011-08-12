<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<?php	# Para la edicion de una Paciente
	if ( isset($_GET['edit']) && isset($_GET['id'])): 
		$id = $_GET['id'];
		$sql = "SELECT * FROM paciente WHERE nro_doc='$id'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
?>

<script language="JavaScript" src="gen_validatorv2.js" type="text/javascript"></script>
<!-- Formulario Edicion -->
<form name="frmPaciente" action="#" method="post">
	<input type="hidden" name="nro_doc" id="nro_doc" value="<?php echo $row["nro_doc"] ?>">
	<h2> Actualizar Paciente </h2>
	<hr>
	</br>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Tipo de Documento:
		</th>
		<td><select name="tipo_doc">
				<?php if ($row["tipo_doc"] == "Cedula") {?>
					<option value="Cedula" SELECTED>Cedula
					<option value="Tarjeta de ID">Tarjeta de ID
					<option value="Pasaporte">Pasaporte
					<option value="Otro">Otro
				<?php } ?>
				<?php if ($row["tipo_doc"] == "Tarjeta de ID") {?>
					<option value="Cedula" >Cedula
					<option value="Tarjeta de ID" SELECTED>Tarjeta de ID
					<option value="Pasaporte">Pasaporte
					<option value="Otro">Otro
				<?php } ?>
				<?php if ($row["tipo_doc"] == "Pasaporte") {?>
					<option value="Cedula" >Cedula
					<option value="Tarjeta de ID">Tarjeta de ID
					<option value="Pasaporte" SELECTED>Pasaporte
					<option value="Otro">Otro
				<?php } ?>
				<?php if ($row["tipo_doc"] == "Otro") {?>
					<option value="Cedula" >Cedula
					<option value="Tarjeta de ID">Tarjeta de ID
					<option value="Pasaporte">Pasaporte
					<option value="Otro" SELECTED>Otro
				<?php } ?>
			</select>
		</td>
		<th>
			Numero de Documento: 
		</th>
		<td>
			<input type="text" name="nro_doc2" id="nro_doc2" value="<?php echo $row["nro_doc"] ?>">
		</td>
	</tr>
	<tr>
		<th> 
			Nombre:
		</th>
		<td>
			<input type="text" name="nombre" id="nombre" value="<?php echo $row["nombre"] ?>">
		</td>
		<th> 
			Segundo Nombre:
		</th>
		<td>
			<input type="text" name="nombre2" id="nombre2" value="<?php echo $row["nombre2"] ?>">
		</td>
	</tr>
	<tr>
		<th> 
			Primer Apellido:
		</th>
		<td> 
			<input type="text" name="apellido1" id="apellido1" value="<?php echo $row["apellido1"] ?>"> 
		</td>
		<th> 
			Segundo Apellido:
		</th>
		<td>
			<input type="text" name="apellido2" id="apellido2" value="<?php echo $row["apellido2"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Fecha de Nacimiento:
		</th>
		<td>
			<script type='text/JavaScript' src='scw.js'></script>
			<input name="fecha_nac" onclick='scwShow(this,this); ' value=<?php echo $row["fecha_nac"]; ?> />
		</td>
		<th>
			Telefono de Casa:
		</th>
		<td>
			<input type="text" name="tel_casa" id="tel_casa" value="<?php echo $row["tel_casa"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Telefono de Trabajo:
		</th>
		<td>
			<input type="text" name="tel_trab" id="tel_trab" value="<?php echo $row["tel_trab"] ?>">
		</td>
		<th> 
			Celular:
		</th>
		<td>
			<input type="text" name="celular" id="celular" value="<?php echo $row["celular"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Direccion:
		</th> 
		<td>
			<input type="text" name="direccion" id="direccion" value="<?php echo $row["direccion"] ?>">
		</td>
		<th>
			Correo Electronico:
		</th>
		<td>
			<input type="text" name="email" id="email" value="<?php echo $row["email"] ?>">
		</td>
	</tr>
	</table>
	<table border=1 cellpadding='10'>
	<tr>
		<th colspan=1>
			Observaciones
		</th>
		<td colspan=2>
			<textarea name="observaciones" rows="3" cols="30"><?php echo $row["observaciones"] ?></textarea>
		</td>
	</tr>
	</table>
	<br>
	<input type="Submit" name="editsubmit" value="Actualizar Paciente" onClick="javascript:formCheck();">
</form>
<script language="JavaScript" type="text/javascript">
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("frmPaciente");
  
  frmvalidator.addValidation("nro_doc2","maxlen=50", "Maximo 50 digitos");
  frmvalidator.addValidation("nro_doc2","numeric", "El Documento debe ser un valor numerico");
  frmvalidator.addValidation("nro_doc2","req","Ingrese el numero del documento del Paciente");
  
  frmvalidator.addValidation("nombre","req","Ingrese el nombre del paciente");
  frmvalidator.addValidation("nombre","maxlen=50",
	"Maximo tamaño de un nombre es de 50");
  frmvalidator.addValidation("nombre","alpha", "Nombre: Solo letras se permiten");
  
  frmvalidator.addValidation("apellido1","req","Ingrese el primer apellido");
  frmvalidator.addValidation("apellido1","maxlen=50",
	"Maximo tamaño de un apellido es de 50");
  frmvalidator.addValidation("apellido1","alpha", "1er Apellido: Solo letras se permiten");
  
  frmvalidator.addValidation("fecha_nac","req","Ingrese la fecha de nacimiento");
  
  frmvalidator.addValidation("tel_casa","maxlen=50");
  frmvalidator.addValidation("tel_casa","numeric", "El Telefono de Casa debe ser un valor numerico");
  
  frmvalidator.addValidation("tel_trab","maxlen=50");
  frmvalidator.addValidation("tel_trab","numeric", "El Telefono de Trabajo debe ser un valor numerico");
  
  frmvalidator.addValidation("celular","maxlen=50");
  frmvalidator.addValidation("celular","numeric", "El Celular debe ser un valor numerico");
  
  frmvalidator.addValidation("email","maxlen=50", "Correo Electronico: Solo hasta 50 caracters");
  frmvalidator.addValidation("email","email", "El Correo Electronico que ingreso es invalido");
  
  
  function formCheck() { 
		nro_docval = document.frmPaciente.nro_doc2.value;
		document.frmPaciente.action = "pacientes.php?num=" + nro_docval;
	}
	
</script>


<?php	// Para la adicion de un paciente
	elseif (isset($_GET['add'])): 
?>
<!-- Formulario Adicion -->
<script language="JavaScript" src="gen_validatorv2.js" type="text/javascript"></script>
<form name="frmPaciente" action="#" method="post">
	<h2>Crear Paciente</h2>
	<hr>
	</br>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Tipo de Documento:
		</th>
		<td><select name="tipo_doc">
				<option value="Cedula">Cedula
				<option value="Tarjeta de ID">Tarjeta de ID
				<option value="Pasaporte">Pasaporte
				<option value="Otro">Otro
			</select>
		</td>
		<th>
			Numero de Documento: 
		</th>
		<td>
			<input type="text" name="nro_doc" id="nro_doc">
		</td>
	</tr>
	<tr>
		<th> 
			Nombre:
		</th>
		<td>
			<input type="text" name="nombre">
		</td>
		<th> 
			Segundo Nombre:
		</th>
		<td>
			<input type="text" name="nombre2">
		</td>
	</tr>
	<tr>
		<th> 
			Primer Apellido:
		</th>
		<td> 
			<input type="text" name="apellido1"> 
		</td>
		<th> 
			Segundo Apellido:
		</th>
		<td>
			<input type="text" name="apellido2">
		</td>
	</tr>
	<tr>
		<th>
			Fecha de Nacimiento:
		</th>
		<td>
			<script type='text/JavaScript' src='scw.js'></script>
			<input name="fecha_nac" onclick='scwShow(this,this); ' />
		</td>
		<th>
			Telefono de Casa:
		</th>
		<td>
			<input type="text" name="tel_casa">
		</td>
	</tr>
	<tr>
		<th>
			Telefono de Trabajo:
		</th>
		<td>
			<input type="text" name="tel_trab">
		</td>
		<th> 
			Celular:
		</th>
		<td>
			<input type="text" name="celular">
		</td>
	</tr>
	<tr>
		<th>
			Direccion:
		</th> 
		<td>
			<input type="text" name="direccion">
		</td>
		<th>
			Correo Electronico:
		</th>
		<td>
			<input type="text" name="email">
		</td>
	</tr>
	</table>
	<table border=1 cellpadding='10'>
	<tr>
		<th colspan=1>
			Observaciones
		</th>
		<td colspan=2>
			<textarea name="observaciones" rows="3" cols="30"></textarea>
		</td>
	</tr>	
	</table>
	</br>
	<input type="Submit" name="addsubmit" value="Registrar Paciente" onClick="javascript:formCheck();">
</form>
<script language="JavaScript" type="text/javascript">
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("frmPaciente");
  
  frmvalidator.addValidation("nro_doc","maxlen=50", "Maximo 50 digitos");
  frmvalidator.addValidation("nro_doc","numeric", "El Documento debe ser un valor numerico");
  frmvalidator.addValidation("nro_doc","req","Ingrese el numero del documento del Paciente");
  
  frmvalidator.addValidation("nombre","req","Ingrese el nombre del paciente");
  frmvalidator.addValidation("nombre","maxlen=50",
	"Maximo tamaño de un nombre es de 50");
  frmvalidator.addValidation("nombre","alpha", "Nombre: Solo letras se permiten");
  
  frmvalidator.addValidation("apellido1","req","Ingrese el primer apellido");
  frmvalidator.addValidation("apellido1","maxlen=50",
	"Maximo tamaño de un apellido es de 50");
  frmvalidator.addValidation("apellido1","alpha", "1er Apellido: Solo letras se permiten");
  
  frmvalidator.addValidation("fecha_nac","req","Ingrese la fecha de nacimiento");
  
  frmvalidator.addValidation("tel_casa","maxlen=50");
  frmvalidator.addValidation("tel_casa","numeric", "El Telefono de Casa debe ser un valor numerico");
  
  frmvalidator.addValidation("tel_trab","maxlen=50");
  frmvalidator.addValidation("tel_trab","numeric", "El Telefono de Trabajo debe ser un valor numerico");
  
  frmvalidator.addValidation("celular","maxlen=50");
  frmvalidator.addValidation("celular","numeric", "El Celular debe ser un valor numerico");
  
  frmvalidator.addValidation("email","maxlen=50", "Correo Electronico: Solo hasta 50 caracters");
  frmvalidator.addValidation("email","email", "El Correo Electronico que ingreso es invalido");
  
  function formCheck() { 
		nro_docval = document.frmPaciente.nro_doc.value;
		document.frmPaciente.action = "pacientes.php?num=" + nro_docval;
	}
 </script>

<?php 
	
	else: // Pagina mostrada por defecto
	
	if ( isset($_POST['addsubmit'])) { #Case Addition
		
		# Recolecta la informacion del formulario
		$tipo_doc = $_POST['tipo_doc'];
		$nro_doc = $_POST['nro_doc'];
		$nombre = $_POST['nombre'];
		$nombre2 = $_POST['nombre2'];
		$apellido1 = $_POST['apellido1'];
		$apellido2 = $_POST['apellido2'];
		$fecha_nac = $_POST['fecha_nac'];
		$tel_casa = $_POST['tel_casa'];
		$tel_trab = $_POST['tel_trab'];
		$celular = $_POST['celular'];
		$direccion = $_POST['direccion'];
		$observaciones = $_POST['observaciones'];
		$email = $_POST['email'];
		
		# Verifica la existencia del usuario.
		$existsSql = "SELECT * FROM paciente
		WHERE nro_doc='$nro_doc'";
		$existsRes = mysql_query($existsSql);
		$numrows = mysql_num_rows($existsRes);
		if ($numrows == 1) { // El usuario  ya existe
			$ERRORS[] = "El paciente con documento ". $nro_doc. " ya existe.";
		}
		
		# Verifica que la fecha sea valida
		if (!checkdate(substr($fecha_nac, 5, 2), substr($fecha_nac, 8, 2), substr($fecha_nac, 0, 4)))
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
		$sql = "insert into paciente SET
				tipo_doc='$tipo_doc',
				nro_doc='$nro_doc',
				nombre='$nombre',
				nombre2='$nombre2',
				apellido1='$apellido1',
				apellido2='$apellido2',
				fecha_nac='$fecha_nac',
				tel_casa='$tel_casa',
				tel_trab='$tel_trab',
				celular='$celular',
				direccion='$direccion',
				observaciones='$observaciones',
				email='$email'";

			
		if (@mysql_query($sql)) {
			echo('<p>Su paciente ha sido ingresado. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su paciente: '.mysql_error().'</p>');
		}
	}
	
	if ( isset($_POST['editsubmit'])) { // En caso de Actualizar un Paciente
		
		#debug
		/*echo "<pre>";
			echo print_r($_POST);
		echo "</pre>"; */
		
		# Recolecta la informacion del formulario
		$tipo_doc = $_POST['tipo_doc'];
		$nro_doc = $_POST['nro_doc'];
		$nro_doc2 = $_POST['nro_doc2'];
		$nombre = $_POST['nombre'];
		$nombre2 = $_POST['nombre2'];
		$apellido1 = $_POST['apellido1'];
		$apellido2 = $_POST['apellido2'];
		$fecha_nac = $_POST['fecha_nac'];
		$tel_casa = $_POST['tel_casa'];
		$tel_trab = $_POST['tel_trab'];
		$celular = $_POST['celular'];
		$direccion = $_POST['direccion'];
		$observaciones = $_POST['observaciones'];
		$email = $_POST['email'];
		
		# Verifica la existencia de la tupla.
		if ($nro_doc != $nro_doc2)
		{
			$existsSql = "SELECT * FROM paciente
			WHERE nro_doc='$nro_doc2'";
			$existsRes = mysql_query($existsSql);
			$numrows = mysql_num_rows($existsRes);
			if ($numrows == 1) { // El usuario  ya existe
				$ERRORS[] = "El paciente con documento ". $nro_doc2. " ya existe.";
			}
		}
		
		# Verifica que la fecha sea valida
		if (!checkdate(substr($fecha_nac, 5, 2), substr($fecha_nac, 8, 2), substr($fecha_nac, 0, 4)))
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
			echo "</ul>";
			echo "<br><br></br>";
			require("footer.php");
			exit;
		}
		
		#sql
		$sql = "update paciente SET
				tipo_doc='$tipo_doc',
				nro_doc='$nro_doc2',
				nombre='$nombre',
				nombre2='$nombre2',
				apellido1='$apellido1',
				apellido2='$apellido2',
				fecha_nac='$fecha_nac',
				tel_casa='$tel_casa',
				tel_trab='$tel_trab',
				celular='$celular',
				direccion='$direccion',
				observaciones='$observaciones',
				email='$email'
				where nro_doc='$nro_doc'";
				
		if (@mysql_query($sql)) {
			echo ('<p>Su paciente ha sido actualizado. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su paciente: '.mysql_error().'</p>');
		}
	}
	
	#Vista Detalle
	if (isset($_GET['num']))  // En caso de ver un paciente en detalle
	{	
		$num = $_GET['num'];
		$sql = "select * from paciente where nro_doc='$num';";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$nom = $row["nombre"];
		$nom2 = $row["nombre2"];
		$ap1 = $row["apellido1"];
		$ap2 = $row["apellido2"];
		echo "<h2>Paciente: $nom $nom2 $ap1 $ap2 </h2><hr/><br/>";
		echo "<table border=1 cellpadding='10' width=600>\n"; // tabla para un registro individual
		printf('<tr><th width="140"><b>Tipo de Documento:</b></th><td>%s</td>', $row["tipo_doc"]);
		printf("<th width='145'><b>Numero de Documento:</b></th><td>%s</td></tr>", $row["nro_doc"]);
		printf("<tr><th><b>Nombre:</td><td>%s</b></th>", $row["nombre"]);
		printf("<th><b>Segundo Nombre:</td><td>%s</b></th></tr>", $row["nombre2"]);
		printf("<tr><th><b>Primer Apellido:</b></th><td>%s</td>", $row["apellido1"]);
		printf("<th><b>Segundo Apellido:</b></td><td>%s</td></tr>", $row["apellido2"]);
		printf("<tr><th><b>Fecha de Nacimiento:</b></th><td>%s</td>", $row["fecha_nac"]);
		printf("<th><b>Telefono de Casa:</b></th><td>%s</td></tr>", $row["tel_casa"]);
		printf("<tr><th><b>Telefono de Trabajo:</b></th><td>%s</td>", $row["tel_trab"]);
		printf("<th><b>Celular:</b></th><td>%s</td></tr>", $row["celular"]);
		printf("<tr><th><b>Direccion:</b></th><td>%s</td>", $row["direccion"]);
		printf("<th><b>Correo Electronico:</b></th><td>%s</td></tr>", $row["email"]);
		echo "</table>\n";
		echo "</br>\n";
		echo "<table border=1 cellpadding='10' width=600>\n";
		printf("<tr><th width='140'><b>Observaciones:</b></th><td colspan=3>%s</td></tr>", $row["observaciones"]);
		echo "</table>\n";
		echo "</br>\n";
		printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n", 
			$_SERVER['PHP_SELF'], $row["nro_doc"]); 
		printf("<a class='button' href=\"citaspac.php?doc=$num&page=1\">Ver Citas</a>");
		printf("<a class='button' href=\"citas.php?add=1&doc=$num\">Crear una Cita</a>");
		echo "<br><br></br>\n";
	}
	else  // Mostrar el listado de Pacientes
	{
		// how many rows to show per page
		$rowsPerPage = 9;
		// by default we show first page
		$pageNum = 1;
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
			$pageNum = $_GET['page'];
		}
		// counting the offset
		$date = date("Y-m-d");
		$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-15, date("Y"))); 
		$offset = ($pageNum - 1) * $rowsPerPage;
		$query = "SELECT citas.nro_doc, nombre, nombre2, apellido1, apellido2 
			FROM PACIENTE, CITAS where fecha BETWEEN '$yesterday' and '$date' 
			and paciente.nro_doc = citas.nro_doc ORDER BY '$date' desc ";			   
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		
		#Si no hay pacientes
		if ($numrows == 0)
		{
			echo "<h1> No Hay Pacientes Recientes </h1>";
			echo '<br><br>';
			printf("<a class=button href=\"buspac.php\">Buscar Paciente</a>");
			echo '<a class=button href="'.$_SERVER['PHP_SELF'].'?add=1">Agregar Paciente</a><br><br></br>';
			echo '<br><br></br>';
			exit;
		}
		
		#vista gral
		echo "<h2>Pacientes Mas Recientes</h2><hr/><br/>";
		echo "<table border=1 cellpadding='5' width=700>";
		echo "<tr><th><b>Nro de Documento</b></th><th><b>Nombre</b>
			</th><th><b>Segundo Nombre</b></th><th><b>Primer Apellido</b>
			</th><th><b>Segundo Apellido</b></th></tr>\n";	
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td><a href=\"%s?num=%s\">%s</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>
			</tr>\n", $_SERVER['PHP_SELF'], $row["nro_doc"], $row["nro_doc"], $row["nombre"], $row["nombre2"], 
			$row["apellido1"], $row["apellido2"]);
		}
		echo "</table>\n";
		echo "<br>";
		# How many rows we have in the database
		$result  = mysql_query($query) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		# How many pages we have when using paging
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
		echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> Paginas " . $next . $last;
		echo "<br><br>";
		printf("<a class=button href=\"buspac.php\">Buscar Paciente</a>");
		echo '<a class=button href="'.$_SERVER['PHP_SELF'].'?add=1">Agregar Paciente</a><br><br></br>';
	}
	endif;
?>
<?php
	require("footer.php");
?>
					