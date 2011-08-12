<?php
	require("db.php");
	require("functions.php");
	require("header.php");
?>

<html>
	<head>
		<title> Resultados de Busqueda </title>
	</head>
	<body>
		<h2> Resultados de Busqueda de Pacientes </h2>
		<hr>
		</br>

<?php	
//  trim($searchterm);

	if (!isset($_GET['page']))
	{
		if (!$_POST['searchtype'] || !$_POST['searchterm']) {
			echo "No haz ingresado detalles de la busqueda. Favor devolverse e intentar de nuevo.";
			echo '<br><br>';
			printf("<a class='button' href=\"buspac.php\">Volver</a>");
			echo '<br><br></br>';
			require("footer.php");
			exit;
		}
		$searchtype = $_POST['searchtype'];
		$searchterm = $_POST['searchterm'];
		$searchtype = addslashes($searchtype);
		$searchterm = addslashes($searchterm);	
	}
	
	// how many rows to show per page
	$rowsPerPage = 5;
	// by default we show first page
	$pageNum = 1;
	// if $_GET['page'] defined, use it as page number
	if( isset($_GET['page']) )
	{
		$pageNum = $_GET['page'];
	}
	if( isset($_GET['page']) && isset($_GET['sterm']) && isset($_GET['stype']) )
	{
		$pageNum = $_GET['page'];
		$searchtype = $_GET['stype'];
		$searchterm = $_GET['sterm'];
		$searchtype = addslashes($searchtype);
		$searchterm = addslashes($searchterm);	
	}
	// counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	
	if ($searchtype == "nro_doc") {
		$query = "select * from paciente where ".$searchtype." = '".$searchterm."' ";
		$pagingQuery = "LIMIT $offset, $rowsPerPage;";
		$result = mysql_query($query . $pagingQuery) or die('Ocurrio un error en la busqueda del paciente');
		$numrows = mysql_num_rows($result);
		
		$numquery = "select * from paciente where ".$searchtype." = '".$searchterm."' ";
		$all = mysql_query($numquery) or die('Ocurrio un error al contar los resultados');
		$allrows = mysql_num_rows($all); 		
	} 
	else {
		$query = "select * from paciente where ".$searchtype." like '".$searchterm."%' ";
		$pagingQuery = "LIMIT $offset, $rowsPerPage";
		$result = mysql_query($query . $pagingQuery) or die('Ocurrio un error en la busqueda del paciente');
		$numrows = mysql_num_rows($result);
		
		$numquery = "select * from paciente where ".$searchtype." like '".$searchterm."%' ";
		$all = mysql_query($numquery) or die('Ocurrio un error al contar los resultados');
		$allrows = mysql_num_rows($all); 
	}
	
	if ($allrows == 0)
	{
		echo "No existen registros con esas especificaciones.";
		echo '<br><br>';
		printf("<a class='button' href=\"buspac.php\">Volver</a>");
		echo '<br><br></br>';
		require("footer.php");
		exit;
	}
	
	echo "<p>Numero de Pacientes encontrados: ".$allrows."</p>";  
	
		echo "<table border=1 cellpadding='10'>\n";
		echo "<tr><th><b>Nro de Documento</b></th><th><b>Nombre</b>
			</th><th><b>Segundo Nombre</b></th><th><b>Primer Apellido</b>
			</th><th><b>Segundo Apellido</b></th></tr>\n";
		
		while ($row = mysql_fetch_array($result)) {		
			printf("<tr><td><a href=\"pacientes.php?num=%s\">%s</a></td><td>%s</td><td>%s
			</td><td>%s</td><td>%s</td></tr>\n", $row["nro_doc"], $row["nro_doc"],
			$row["nombre"], $row["nombre2"], $row["apellido1"], $row["apellido2"]);
		}
	echo "</table>\n";
	echo "<br/>";
	
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
		$prev = " <a href=\"$self?page=$page&sterm=$searchterm&stype=$searchtype\">[Anterior]</a> ";

		$first = " <a href=\"$self?page=1&sterm=$searchterm&stype=$searchtype\">[Primera Pagina]</a> ";
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
		$next = " <a href=\"$self?page=$page&sterm=$searchterm&stype=$searchtype\">[Siguiente]</a> ";

		$last = " <a href=\"$self?page=$maxPage&sterm=$searchterm&stype=$searchtype\">[Ultima Pagina]</a> ";
	}
	else
	{
		$next = ' [Siguiente] ';      // we're on the last page, don't enable 'next' link
		$last = ' [Ultima Pagina] '; // nor 'last page' link
	}

	// print the page navigation link
	echo $first . $prev . " Mostrando Pagina <strong>$pageNum</strong> de <strong>$maxPage</strong> Paginas " . $next . $last;
	echo '<br><br>';
	printf("<a class='button' href=\"buspac.php\">Volver</a>");
	echo '<br><br></br>';
	require("footer.php");
?>

	
		