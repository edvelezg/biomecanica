<?php
  require("db.php");
  require("functions.php");
  require("header.php");
?>

<?php
  if (isset($_GET['edit']) && isset($_GET['id'])): // PARA EDITAR EL ESTADO DE ARTEJOS
  $id = $_GET['id'];
  $sql = "select nro_cita, art_tipo, art_lado, art_notas from citas
    where nro_cita='$id';";
  $result = mysql_query($sql);
  $numrows = mysql_num_rows($result);
  $row = mysql_fetch_array($result);
?>

<form action="artejos.php?cit=<?php echo $row["nro_cita"] ?>" method="post">
	<h2>Editar Artejos </h2>
	<table border="1" cellpadding='10'>
		<input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>">
		<tr>
			<th>Tipo</th>
			<td>
				<select name="art_tipo">
						<?php if ($row["art_tipo"] == "Martillo") {?> 
                <option value="">Seleccione un Tipo... <option value="Martillo" SELECTED>Martillo
					<option value="Cuello de Cisne">Cuello de Cisne <option value="En Garra">En 
					Garra <option value="Normal">Normal
						<?php } elseif ($row["art_tipo"] == "Cuello de Cisne") {?> 
                <option value="">Seleccione un Tipo... <option value="Martillo">Martillo <option value="Cuello de Cisne" SELECTED>Cuello 
								de Cisne <option value="En Garra">En Garra <option value="Normal">Normal
						<?php } elseif ($row["art_tipo"] == "En Garra") {?> 
                <option value="">Seleccione un Tipo... <option value="Martillo">Martillo <option value="Cuello de Cisne">Cuello 
								de Cisne <option value="En Garra" SELECTED>En Garra <option value="Normal">Normal
						<?php } elseif ($row["art_tipo"] == "Normal") {?> 
                <option value="">Seleccione un Tipo... <option value="Martillo">Martillo <option value="Cuello de Cisne">Cuello 
								de Cisne <option value="En Garra">En Garra <option value="Normal" SELECTED>Normal
						<?php } else { ?> 
                <option value="" SELECTED>Seleccione un Tipo... <option value="Martillo">Martillo
					<option value="Cuello de Cisne">Cuello de Cisne <option value="En Garra" >En 
					Garra <option value="Normal">Normal
						<?php } ?> 
         
				</select>
			</td>
		</tr>
		<tr>
			<th>Lado (Hallux Valgus):</th>
			<td>
				<select name="art_lado">
						<?php if ($row["art_lado"] == "Derecho") {?> 
                <option value="">Seleccione un lado... <option value="Derecho" SELECTED>Derecho <option value="Izquierdo">Izquierdo
					<option value="Bilateral">Bilateral
						<?php } elseif ($row["art_lado"] == "Izquierdo") {?> 
                <option value="">Seleccione un lado... <option value="Derecho">Derecho <option value="Izquierdo" SELECTED>Izquierdo
					<option value="Bilateral">Bilateral
						<?php } elseif ($row["art_lado"] == "Bilateral") {?> 
                <option value="">Seleccione un lado... <option value="Derecho">Derecho <option value="Izquierdo">Izquierdo
					<option value="Bilateral" SELECTED>Bilateral
						<?php } else { ?> 
                <option value="" SELECTED>Seleccione un lado... <option value="Derecho">Derecho <option value="Izquierdo">Izquierdo
					<option value="Bilateral">Bilateral
						<?php } ?> 
        </td>
		</tr>
		<tr>
			<th>Notas:</th>
			<td><textarea name="art_notas" rows="3" cols="30"><?php echo $row["art_notas"] ?></textarea></td>
		</tr>
	</table>
	<br>
	<input type="Submit" name="editsubmit" value="Actualizar">
</form>

<?php
  else:
    if (isset($_POST['editsubmit'])) {
    // Accion de EDITAR
    $id = $_POST['nro_cita']; // Identificador del nro_cita que se va a editar.
    $art_tipo = $_POST['art_tipo'];
    $art_lado = $_POST['art_lado'];
    $art_notas = $_POST['art_notas'];
    $sql = "UPDATE citas SET
      art_tipo = '$art_tipo',
      art_lado = '$art_lado',
      art_notas = '$art_notas'
      WHERE nro_cita='$id';";
     
    if (@mysql_query($sql)) {
      echo('<p>Su cita ha sido Actualizada. </p>');
    } else {
      echo ('<p>Ocurrio un Error al actualizar su cita: '.mysql_error().'</p>');
    }
  }
   
  if (isset($_GET['cit'])) {
    $cit = $_GET['cit'];
    $sql = "select nro_cita, nro_doc, art_tipo, art_lado, art_notas from
      citas where nro_cita='$cit';";
    $result = mysql_query($sql);
    $numrows = mysql_num_rows($result);
     
    if ($numrows == 0) {
       
      echo "<h1> No Hay Estado de Artejos para esta Cita </h1>";
      echo "No hay Estado de Artejos.";
       
    } else {
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
       
      echo "<h3>Podograma . Diagnostico . Artejos .
        <a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2
        $pacapellido1 $pacapellido2 </h3></a><hr/><br/>";
       
      echo "<table border=1 cellpadding='10' width=375>\n";
      printf("<tr><th width=125><b>Tipo:</b></th><td>%s</td></tr>", $row["art_tipo"]);
      printf("<tr><th><b>Lado:</th><td>%s</b></td></tr>", $row["art_lado"]);
      printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["art_notas"]);
      echo "</table>\n";
    }
    echo "<br>\n";
    printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n",
      $_SERVER['PHP_SELF'], $row["nro_cita"]);
    printf("<a class='button' href=\"citas.php?num=$cit\">Volver</a>");
    echo "<br><br><br>\n";
  }
   
  endif;
  require("footer.php");
?>
                     

