<?php
	session_start();
	if(isset($_SESSION['SESS_CHANGEID']) == TRUE) // Genera un identificador de sesion
	{
		session_unset();
		session_regenerate_id();
	}
	require("config.php");

	$db = mysql_connect($dbhost, $dbuser, $dbpassword); // Se conecta a la base de datos
	mysql_select_db($dbdatabase, $db);
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo $config_sitename; ?></title>
	<link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>
<body>
	<div id="header">
	<h1><?php echo $config_sitename; ?></h1>
	</div>
	<div id="menu">
		<a href="<?php echo $config_basedir; ?>">Home</a>
	</div>
	<div id="container">
		<div id="bar">
			<?php
				if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE)
				{
					include("bar.php"); // Incluye la barra de opciones si hay un login adecuado.
				}
				echo "<hr>";
				if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE)
				{
					echo "Logged in as <strong>" . $_SESSION['SESS_USERNAME']
					. "</strong>
					[<a href='" . $config_basedir
					. "logout.php'>logout</a>]";
				} else {
					echo "<a href='"
					. $config_basedir . "login.php'>Login</a>";
				}
			?>
		</div>
	<div id="main">