<?php
	require("db.php");
	require("functions.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo $config_sitename; ?></title>
	<link rel="stylesheet" href="style1.css" type="text/css"/>
<style>
.report{
	margin: 10px auto auto 10px;
}

h2 {
	text-align: center;
}
</style>
</head>

<body>
<?php  
	#Reporte del Paciente				
	if (isset($_GET['num'])) #Reporte de un paciente dado un numero de Cita
	{	
		$num = $_GET['num'];
		#sql
		$sql = "select * from citas, paciente where nro_cita='$num' and citas.nro_doc=paciente.nro_doc;";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		echo "<div class='report'>";
		echo "<h2>Reporte de Cita</h2>";
		
		#Informacion del Paciente
		echo "<table id='tabla1' class='report' border=1 cellpadding='10' width=700>\n"; // tabla para un registro individual
		echo "<caption>Informacion del Paciente</caption>\n";
		printf('<tr><th width="190"><b>Tipo de Documento:</b></th><td>%s</td>', $row["tipo_doc"]);
		printf("<th><b>Numero de Documento:</b></th><td>%s</td></tr>", $row["nro_doc"]);
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
		
		#Informacion Gral
		echo "<table id='tabla2' class='report' border=1 cellpadding='10' width=700>\n";
		echo "<caption>Informacion General</caption>\n";
		printf("<tr><th><b>Momento de Impresion:</b></th><td>%s</td></tr>", $row["mom_impresion"]);
		printf("<tr><th><b>Fecha:</td><td>%s</b></th></tr>", $row["fecha"]);
		printf("<tr><th><b>Ocupacion:</b></th><td>%s</td></tr>", $row["ocupacion"]);
		printf("<tr><th><b>Deporte:</b></th><td>%s</td></tr>", $row["deporte"]);
		printf("<tr><th><b>Consulta:</b></th><td>%s</td></tr>", $row["consulta"]);
		printf("<tr><th><b>Peso:</b></th><td>%s kg</td></tr>", $row["peso"]);
		printf("<tr><th><b>Medico Tratante:</b></th><td>%s</td></tr>", $row["doctor"]);
		printf("<tr><th><b>Institucion:</b></th><td>". $row['institucion'] . "</td></tr>");
		echo "</table>\n";
		
		echo "<table id='tabla3' width=700>\n";
		echo "<tr>";
		echo "<td>";
		#Estado Pies
		echo "<table id='estadopies' class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Estado de Pies</caption>\n";
		if ($row["huellas"] == 0)
			printf("<tr><th><b>Huellas Iguales:</b></th><td>No</td></tr>");
		else
			printf("<tr><th><b>Huellas Iguales:</b></th><td>Si</td></tr>");
		printf("<tr><th><b>Tipo:</b></th><td>%s</td></tr>", $row["ep_tipo"]);
		printf("<tr><th><b>Grado:</b></th><td>%s</td></tr>", $row["ep_grado"]);
		printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["ep_notas"]);
		echo "</table>\n";
		echo "</td>";
		echo "<td>";
		#Artejos
		echo "<table id='artejos' class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Artejos</caption>\n";
		printf("<tr><th><b>Tipo:</b></th><td>%s</td></tr>", $row["art_tipo"]);
		printf("<tr><th><b>Lado:</th><td>%s</b></td></tr>", $row["art_lado"]);
		printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["art_notas"]);
		echo "</table>\n";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo "<table id='antepies' class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Antepies</caption>\n";
		printf("<tr><th><b>Tipo:</b></th><td>%s %s</td></tr>", $row["ant_tipo1"], $row["ant_tipo2"]);
		printf("<tr><th><b>Arco Transversal:</b></th><td>%s</td></tr>", $row["arco_trans"]);
		printf("<tr><th><b>Notas:</b></th><td>%s</td></tr>", $row["ant_notas"]);
		echo "</table>\n";
		
		echo "</td>\n";
		echo "<td>\n";
		
		#Tobillos
		echo "<table id='tobillos' class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Tobillos</caption>\n";
		printf("<tr><th><b>Tipo (Tobillos):</b></th><td>%s</td></tr>", $row["tob_tipo"]);
		printf("<tr><th><b>Notas (Tobillos):</b></th><td>%s</td></tr>", $row["tob_notas"]);
		echo "</table>\n";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>\n";
		#Tibias
		echo "<table class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Tibias</caption>\n";
		printf("<tr><th><b>Tipo (Tibias):</th><td>%s</b></td></tr>", $row["tib_tipo"]);
		printf("<tr><th><b>Notas (Tibias):</b></th><td>%s</td></tr>", $row["tib_notas"]);
		echo "</table>\n";
		
		echo "</td>\n";
		echo "<td>";
		
		#Rodillas y Piel
		echo "<table class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Rodillas y Piel</caption>\n";
		printf("<tr><th><b>Tipo (Rodillas):</b></th><td>%s</td></tr>", $row["rod_tipo"]);
		printf("<tr><th><b>Notas:</td><td>%s</b></th></tr>", $row["rod_notas"]);
		printf("<tr><th><b>Piel Callos:</b></th><td>%s</td></tr>", $row["piel_callos"]);
		echo "</table>\n";
		
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>\n";
		
		#Columna
		echo "<table class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Columna</caption>\n";
		if ($row["escoliosis"] == 0)
			printf("<tr><th><b>Escoliosis:</b></th><td>No</td></tr>");
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
		
		echo "</td>\n";
		echo "<td>";
		
		#Tipo de Zapato
		echo "<table class='report' border=1 cellpadding='10' width=325>\n";
		echo "<caption>Tipo de Zapato</caption>\n";
		printf("<tr><th><b>Tipo de Calzado Actual:</b></th><td>%s</td></tr>", $row["zap_tipo"]);
		printf("<tr><th><b>Descripcion:</b></th><td>%s</td></tr>", $row["zap_desc"]);
		printf("<tr><th><b>Altura (Tacon):</th><td>%s</b> cm</td></tr>", $row["zap_alt"]);
		printf("<tr><th><b>Punta:</b></th><td>%s</td></tr>", $row["zap_punta"]);
		echo "</table>\n";
		
		echo "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		
		#Diagnostico
		echo "<table class='report' border=1 cellpadding='10' width=700>\n";
		echo "<caption>Diagnostico</caption>\n";
		printf("<tr><th><b>Diagnostico:</b></th><td colspan=3>%s</td>", $row["diagnostico"]);
		printf("<tr><th><b>Plantillas:</b></th><td colspan=3>%s</td>", $row["plantillas"]);
		echo "</table>\n";
		
		#Medidas
		/*echo "<table class='report' border=1 cellpadding='10' width=700>\n";
		echo "<caption>Medidas</caption>\n";
		printf("<tr><th><b>Tamaño (Zapato):</b></th><td>%s</td>", $row["tamano"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["tam_mod"]);
		printf("<tr><th><b>Arco Longitudinal:</b></th><td>%s</td>", $row["arcolong"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["arc_mod"]);
		printf("<tr><th><b>Boton Metatarsiano:</b></th><td>%s</td>", $row["boton"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["bot_mod"]);
		printf("<tr><th><b>Cuñas:</b></th><td>%s</td>", $row["cunas"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["cun_mod"]);
		printf("<tr><th><b>Taloneras:</b></th><td>%s</td>", $row["taloneras"]);
		printf("<th><b>Modificado:</b></th><td>%s</td></tr>", $row["tal_mod"]);
		printf("<tr><th colspan=2><b>Otro:</b></th><td colspan=2>%s</td></tr>", $row["med_otro"]);
		echo "</table>\n";*/
		
		#Imagenes
		$foto = $row['foto'];
		$podograma = $row['podograma'];
		echo "<table id='tabla4' width=700>\n";
		echo "<caption class='imagenes'>Imagenes</caption>\n";
		echo "<tr><td><img width=350 src='./uploads/$foto' alt='La imagen no se encuentra en el directorio /uploads/'></td>";
		echo "<td><img width=350 src='./uploads/$podograma' alt='La imagen no se encuentra en el directorio /uploads/'></td></tr>";
		echo "</table>\n";

	}
?>			
</body>
</html>