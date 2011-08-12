<?php
	require("db.php");
	require("functions.php");
	require("header.php");
		
	// Citas de un Doctor
	if (isset($_GET['doc'])) 
	{   
		$doc = $_GET['doc'];		
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
		
		$query = "SELECT nro_cita, fecha, mom_impresion, doctor, institucion,
				nro_doc FROM CITAS WHERE nro_doc='$doc' ORDER BY fecha desc ";
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Error, query failed');
		$numrows = mysql_num_rows($result);
		
		#Informacion Paciente
		$pacsql = "SELECT * FROM paciente WHERE nro_doc='$doc'";
		$pacresult = mysql_query($pacsql);
		$pacrow = mysql_fetch_array($pacresult);
		$pacnombre = $pacrow["nombre"];
		$pacnombre2 = $pacrow["nombre2"];
		$pacapellido1 = $pacrow["apellido1"];
		$pacapellido2 = $pacrow["apellido2"];
		
		if ($numrows == 0) {
		
			echo "<h1> No Hay Citas Asociadas a este Paciente </h1>";
			echo "<h2> Paciente: <a href=\"pacientes.php?num=$doc\">$pacnombre $pacnombre2 $pacapellido1 $pacapellido2</a></h2>";
			exit();
		}

		echo "<h2> Citas del Paciente: <a href=\"pacientes.php?num=$doc\">$pacnombre $pacnombre2 $pacapellido1 $pacapellido2</a></h2> <hr> <br>";
		echo "<table border=1 cellpadding='10' width=600>\n";
		echo "<tr><th><b>Fecha</b></th><th><b>Documento Paciente</b></th><th><b>Momento de Impresion</b>
			</th><th><b>Medico</b></th><th><b>Institucion</b></th></tr>\n";
		
		while ( $row = mysql_fetch_array($result) ) {		
			printf("<tr><td><a href=\"citas.php?num=%s\">%s</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",
			$row["nro_cita"], $row["fecha"], $row["nro_doc"], $row["mom_impresion"], $row["doctor"], $row["institucion"]);
		}
		echo "</table>\n";
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
			$prev = " <a href=\"$self?doc=$doc&page=$page\">[Anterior]</a> ";

			$first = " <a href=\"$self?doc=$doc&page=1\">[Primera Pagina]</a> ";
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
			$next = " <a href=\"$self?doc=$doc&page=$page\">[Siguiente]</a> ";

			$last = " <a href=\"$self?doc=$doc&page=$maxPage\">[Ultima Pagina]</a> ";
		}
		else
		{
			$next = ' [Siguiente] ';      // we're on the last page, don't enable 'next' link
			$last = ' [Ultima Pagina] '; // nor 'last page' link
		}

		// print the page navigation link
		echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> Paginas " . $next . $last;
		echo "<br><br>\n";
		printf("<a class='button' href=\"citas.php?add=1&doc=$doc\">Crear una Cita</a>");
		printf("<a class=button href=\"pacientes.php?num=$doc\">Volver</a>");
		echo "<br><br></br>\n";
	}
	
	require("footer.php");
?>
					