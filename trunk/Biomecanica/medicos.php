<?php
	require("db.php");
	require("functions.php");
	
	require("header.php");
?>

<?php	
	if ( isset($_GET['edit']) && isset($_GET['id'])): #case edit id
		$id = $_GET['id'];
		#sql
		$sql = "SELECT * FROM medicos WHERE nombre='$id'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
?>

<script language="JavaScript" src="gen_validatorv2.js" type="text/javascript"></script>
<form name="frmMedicos" action="#" method="post">
	<input type="hidden" name="nombre_old" value="<?php echo $row["nombre"] ?>">
	<h2>Modificar Medico</h2>
	<hr>
	<br>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Numero de Documento:
		</th>
		<td>
			<input type="text" name="id_med" value="<?php echo $row["id_med"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Nombre: 
		</th>
		<td>
			<input type="text" name="nombre" id="nombre" value="<?php echo ucwords($row["nombre"]) ?>">
		</td>
	</tr>
	<tr>
		<th> 
			Direccion:
		</th>
		<td>
			<input type="text" name="direccion" value="<?php echo $row["direccion"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Telefono
		</th>
		<td>
			<input type="text" name="telefono" value="<?php echo $row["telefono"] ?>">
		</td>
	</tr>
	<tr>
		<th>
			Celular
		</th>
		<td>
			<input type="text" name="celular" value="<?php echo $row["celular"] ?>">
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
	<tr>
		<th> 
			Correo Electronico:
		</th>
		<td>
			<input type="text" name="email" value="<?php echo $row["email"] ?>">
		</td>
	</tr>
	</table>
	</br>
	<input type="Submit" name="editsubmit" value="Actualizar Medico" onClick="javascript:formCheck();">
</form>
<script language="JavaScript" type="text/javascript">
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("frmMedicos");
  
  frmvalidator.addValidation("id_med","maxlen=50", "Maximo 50 digitos");
  frmvalidator.addValidation("id_med","numeric", "El Documento debe ser un valor numerico");
  
  frmvalidator.addValidation("nombre","req","Ingrese el nombre del medico");
  frmvalidator.addValidation("nombre","maxlen=50",
	"Maximo tamaño de un nombre es de 50");
  
  frmvalidator.addValidation("telefono","maxlen=50");
  frmvalidator.addValidation("telefono","numeric", "El Telefono debe contener solo digitos");
  
  frmvalidator.addValidation("celular","maxlen=50");
  frmvalidator.addValidation("celular","numeric", "El Celular debe contener solo digitos");
  
  frmvalidator.addValidation("email","maxlen=50", "Correo Electronico: Solo hasta 50 caracters");
  frmvalidator.addValidation("email","email", "El Correo Electronico que ingreso es invalido");
  
  function formCheck() { 
	nombreval = document.frmMedicos.nombre.value;
	document.frmMedicos.action = "medicos.php?nom=" + nombreval;
  }
	
</script>

<?php	
	elseif ( isset($_GET['add'])): # Accion add
?>

<script language="JavaScript" src="gen_validatorv2.js" type="text/javascript"></script>
<form id="frmMedicos" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" OnSubmit="return ValidateForm()">
	<h2>Agregar Medico</h2>
	<table border=1 cellpadding='10'>
	<tr>
		<th>
			Numero de Documento:
		</th>
		<td>
			<input type="text" name="id_med">
		</td>
	</tr>
	<tr>
		<th>
			Nombre: 
		</th>
		<td>
			<input type="text" name="nombre">
		</td>
	</tr>
	<tr>
		<th> 
			Direccion:
		</th>
		<td>
			<input type="text" name="direccion">
		</td>
	</tr>
	<tr>
		<th>
			Telefono
		</th>
		<td>
			<input type="text" name="telefono">
		</td>
	</tr>
	<tr>
		<th>
			Celular
		</th>
		<td>
			<input type="text" name="celular">
		</td>
	</tr>
	<tr>
		<th>
			Institucion:
		</th>
		<td>
			<input type="text" name="institucion">
		</td>
	</tr>
	<tr>
		<th> 
			Correo Electronico:
		</th>
		<td>
			<input type="text" name="email">
		</td>
	</tr>
	</table>
	</br>
	<input type="Submit" name="addsubmit" value="Registrar Medico">
</form>
<script language="JavaScript" type="text/javascript">
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("frmMedicos");
  
  frmvalidator.addValidation("id_med","maxlen=50", "Maximo 50 digitos");
  frmvalidator.addValidation("id_med","numeric", "El Documento debe ser un valor numerico");
  
  frmvalidator.addValidation("nombre","req","Ingrese el nombre del medico");
  frmvalidator.addValidation("nombre","maxlen=50", "Maximo tamaño de un nombre es de 50");
  
  frmvalidator.addValidation("telefono","maxlen=50");
  frmvalidator.addValidation("telefono","numeric", "El Telefono debe contener solo digitos");
  
  frmvalidator.addValidation("celular","maxlen=50");
  frmvalidator.addValidation("celular","numeric", "El Celular debe contener solo digitos");
  
  frmvalidator.addValidation("email","maxlen=50", "Correo Electronico: Solo hasta 50 caracters");
  frmvalidator.addValidation("email","email", "El Correo Electronico que ingreso es invalido");
</script>

<?php
	
	else: #Default Page
	
	if ( isset($_POST['addsubmit'])) { #case add
	
		#recoleccion de datos
		$id_med = $_POST['id_med'];
		$nombre = strtolower($_POST['nombre']);
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$celular = $_POST['celular'];
		$institucion = $_POST['institucion'];
		$email = $_POST['email'];
		
		#sql
		$existsSql = "SELECT * FROM medicos
		WHERE id_med='$id_med'";
		$existsRes = mysql_query($existsSql);
		$numrows = mysql_num_rows($existsRes);
		
		if ($numrows == 1) { #verfica existencia
 			echo "Error: El medico con documento ". $id_med. " ya existe.";
			require("footer.php");
			exit;
		}
		
		#sql
		$sql = "insert into medicos SET
				id_med='$id_med',
				nombre='$nombre',
				direccion='$direccion',
				telefono='$telefono',
				celular='$celular',
				institucion='$institucion',
				email='$email'";
		
		if (@mysql_query($sql)) {
			echo('<p>Su medico ha sido ingresado. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su medico: '.mysql_error().'</p>');
		}
	}
	
	if ( isset($_POST['editsubmit'])) {
		$id_med = $_POST['id_med'];
		$nombre_old = strtolower($_POST['nombre_old']);
		$nombre = strtolower($_POST['nombre']);
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$celular = $_POST['celular'];
		$institucion = $_POST['institucion'];
		$email = $_POST['email'];
		
		#sql
		$sql = "UPDATE MEDICOS SET
				id_med='$id_med',
				nombre='$nombre',
				direccion='$direccion',
				telefono='$telefono',
				celular='$celular',
				institucion='$institucion',
				email='$email'
				where nombre='$nombre_old';";
		
		# Verifica la existencia de la tupla.
		if ($nombre != $nombre_old)
		{
			#sql
			$existsSql = "SELECT * FROM medicos
			WHERE id_med='$id_med'";
			$existsRes = mysql_query($existsSql);
			$numrows = mysql_num_rows($existsRes);
			if ($numrows == 1) { #verfica existencia
	 			echo "Error: El medico con documento ". $id_med. " ya existe.";
				require("footer.php");
				exit;
			}
		}
		

				
		if (@mysql_query($sql)) {
			echo('<p>Su medico ha sido Actualizado. </p>');
		} else {
			echo ('<p>Ocurrio un Error al ingresar su medico: '.mysql_error().'</p>');
		}
	}
	
	if (isset($_GET['nom']) || isset($_GET['ins'])) // Mostrar la informacion detallada de un medico
	{
		if (isset($_GET['ins']))
		{
			$ins = $_GET['ins'];
			$sql = "select * from medicos where institucion='$ins';";
		}
		elseif (isset($_GET['nom']))
		{
			$name = $_GET['nom'];
			$sql = "select * from medicos where nombre='$name';";
		}
		
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$nom = $row["nombre"];
		
		#Title
		#Vista Detalles
		echo "<h2><strong>Medico: </strong>".ucwords($nom)."</h2><hr/><br/>";
		echo "<table border=1 cellpadding='10' width=600>\n";
		printf("<tr><th width=170><b>Numero de Documento:</b></th><td>%s</td></tr>", $row["id_med"]);
		printf("<tr><th><b>Nombre:</b></th><td>%s</td></tr>", ucwords($row["nombre"]));
		printf("<tr><th><b>Direccion:</b></th><td>%s</td></tr>", $row["direccion"]);
		printf("<tr><th><b>Telefono:</b></th><td>%s</td></tr>", $row["telefono"]);
		printf("<tr><th><b>Celular:</b></th><td>%s</td></tr>", $row["celular"]);
		printf("<tr><th><b>Institucion:</b></th><td>%s</td></tr>", $row["institucion"]);
		printf("<tr><th><b>Correo Electronico:</b></th><td>%s</td></tr>", $row["email"]);
		echo "</table>\n";
		echo "</br>\n";
		printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n", 
			$_SERVER['PHP_SELF'], $row["nombre"]); 	
		printf("<a class='button' href=\"citasdoc.php?med=$nom\">Ver Citas</a>");
		echo "<br><br></br>\n";
	}
	else // Mostrar el Listado de Medicos
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
		$offset = ($pageNum - 1) * $rowsPerPage;
		$query = "select count(doctor) as total , nombre, medicos.institucion from citas, 
			medicos where doctor = nombre group by doctor order by count(doctor) desc ";			   
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Error, query failed');	
		$numrows = mysql_num_rows($result);		
		#Vista Gral
		echo "<h1> Medicos </h1><hr/><br/>"; 
		echo "<table border=1 cellpadding='5' width=600>\n";
		echo "<tr><th width=230><b>Nombre</b></th><th><b># de Citas</b></th><th><b>Institucion</b></th></tr>\n";
		while ( $row = mysql_fetch_array($result) ) {			
			printf("<tr><td><a href=\"%s?nom=%s\">%s</a></td><td>%s</td><td>%s</td></tr>\n", $_SERVER['PHP_SELF'],
			$row["nombre"], ucwords($row["nombre"]), $row["total"], $row["institucion"]);
		}
		echo "</table>\n";
		if ($numrows == 0) // Condicion para revisar si hay medicos.
		{
			echo "<h2> No hay Medicos </h2>";
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
		echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> Paginas " . $next . $last;
		echo "<br><br>";
		printf("<a class=button href=\"busmed.php\">Buscar Medico</a>");
		echo ('<a class="button" href="'.$_SERVER['PHP_SELF'].'?add=1">Agregar Medico</a>');
		echo "<br><br></br>";
	}
	endif;
?>
<?php
	require("footer.php");
?>
