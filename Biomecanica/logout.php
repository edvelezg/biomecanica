<?php
	// Se termina sesion cuando un usuario se retira
	session_start();
	require("config.php");
	session_unregister("SESS_LOGGEDIN");
	session_unregister("SESS_USERNAME");
	session_unregister("SESS_USERID");
	header("Location: " . $config_basedir);
?>
	
	