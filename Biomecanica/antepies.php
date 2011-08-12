<?php
  require("db.php");
  require("functions.php");
  require("header.php");
?>

<?php
  if (isset($_GET['edit']) && isset($_GET['id'])): // Para editar el estado de antepies
  $id = $_GET['id'];
  $sql = "select nro_cita, ant_tipo1, ant_tipo2,
    arco_trans, ant_notas from citas where nro_cita='$id';";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
?>

<form action="antepies.php?cit=<?php echo $row["nro_cita"] ?>" method="post"> 
    <h2>Antepies </h2> 
    <!-- Recoge los datos anteriores y los vuelve a presentar dando la opcion de modificarlos.--> 
    <table border="1" cellpadding='10'> 
        <input type="hidden" name="nro_cita" value="<?php echo $row["nro_cita"] ?>"> 
        <tr> 
            <th>Tipo (Antepie):</th> 
            <td> 
                <select name="ant_tipo1"> 
                    <?php if ($row["ant_tipo1"] == "Normal") {?> 
                <option value="">Seleccione un tipo... <option value="Normal" SELECTED>Normal <option value="Adductus">Adductus 
                    <option value="Abductus">Abductus 
                        <?php } elseif ($row["ant_tipo1"] == "Adductus") {?> 
                <option value="">Seleccione un tipo... <option value="Normal">Normal <option value="Adductus" SELECTED>Adductus 
                    <option value="Abductus">Abductus 
                        <?php } elseif ($row["ant_tipo1"] == "Abductus") {?> 
                <option value="">Seleccione un tipo... <option value="Normal">Normal <option value="Adductus">Adductus 
                    <option value="Abductus" SELECTED>Abductus 
                        <?php } else {?> 
                <option value="" SELECTED>Seleccione un tipo... <option value="Normal">Normal <option value="Adductus">Adductus 
                        <?php } ?> 
                <option value="Abductus">Abductus 
                </select> 

                <select name="ant_tipo2"> 
                        <?php if ($row["ant_tipo2"] == "Pronado") {?> 
                <option value="">Seleccione... <option value="Supinado">Supinado <option value="Pronado" SELECTED>Pronado 
                        <?php } elseif ($row["ant_tipo2"] == "Supinado") {?> 
                <option value="">Seleccione... <option value="Supinado" SELECTED>Supinado <option value="Pronado">Pronado 
                        <?php } else {?> 
                <option value="" SELECTED>Seleccione... <option value="Supinado">Supinado <option value="Pronado">Pronado 
                        <?php } ?> 
             
                </select> 
            </td> 
        </tr> 
        <tr> 
            <th>Arco Transversal:</th> 
            <td> 
                <select name="arco_trans"> 
                        <?php if ($row["arco_trans"] == "Caido") {?> 
                <option value="">Seleccione... <option value="Caido" SELECTED>Caido <option value="Normal">Normal 
                        <?php } elseif ($row["arco_trans"] == "Normal") {?> 
                <option value="">Seleccione... <option value="Caido">Caido <option value="Normal" SELECTED>Normal 
                        <?php } else { ?> 
                <option value="" SELECTED>Seleccione... <option value="Caido">Caido <option value="Normal">Normal 
                        <?php } ?> 
             
                </select> 
            </td> 
        </tr> 
        <tr> 
            <th>Notas:</th> 
            <td><textarea name="ant_notas" rows="3" cols="30"><?php echo $row["ant_notas"] ?></textarea></td> 
        </tr> 
    </table> 
    <br> 
    <input type="Submit" name="editsubmit" value="Actualizar"> 
</form> 

<?php
  else: // La Pagina que se muestra por defecto
   
  if (isset($_POST['editsubmit'])) {
    // Accion para editar el estado de los antepies
    $id = $_POST['nro_cita']; // Identificador del nro_cita que se va a editar.
    $ant_tipo1 = $_POST['ant_tipo1'];
    $ant_tipo2 = $_POST['ant_tipo2'];
    $arco_trans = $_POST['arco_trans'];
    $ant_notas = $_POST['ant_notas'];
    $sql = "UPDATE citas SET
      ant_tipo1 = '$ant_tipo1',
      ant_tipo2 = '$ant_tipo2',
      arco_trans = '$arco_trans',
      ant_notas = '$ant_notas'
      WHERE nro_cita='$id';";
     
    if (@mysql_query($sql)) {
      echo('<p>Su cita ha sido Actualizada. </p>');
    } else {
      echo ('<p>Ocurrio un Error al actualizar su cita: '.mysql_error().'</p>');
    }
  }
  if (isset($_GET['cit'])) {
    #case cit
    $cit = $_GET['cit'];
    $sql = "select nro_cita, nro_doc, ant_tipo1, ant_tipo2,
      arco_trans, ant_notas from citas where nro_cita='$cit';";
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
    echo "<h3>Podograma . Diagnostico . Antepies .
      <a href=\"pacientes.php?num=$nropac\">$pacnombre $pacnombre2
      $pacapellido1 $pacapellido2 </a></h3><hr><br/>";
     
    #Vista Detalles
    echo "<table border=1 cellpadding='10' width=375>\n";
    printf("<tr><th width=125><b>Tipo:</b></th><td>%s %s</td></tr>", $row["ant_tipo1"], $row["ant_tipo2"]);
    printf("<tr><th><b>Arco Transversal:</th><td>%s</b></td></tr>", $row["arco_trans"]);
    printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["ant_notas"]);
    echo "</table>\n";
  }
   
  echo "<br>\n";
  printf("<a class='button' href=\"%s?edit=1&id=%s\">Editar</a>\n",
    $_SERVER['PHP_SELF'], $row["nro_cita"]);
  printf("<a class='button' href=\"citas.php?num=$cit\">Volver</a>");
  echo "<br><br><br>\n";
   
  endif;
  require("footer.php");
?>
                     
