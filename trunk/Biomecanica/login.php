<?php
session_start();
require("db.php");
	if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE) { // Verificar que haya Sesion;
		header("Location: " . $config_basedir);
	}
	if($_POST['submit']) { // Si se intenta loggear
		$loginsql = "SELECT * FROM logins
		WHERE username = '" . $_POST['userBox']
		. "' AND password = '" . $_POST['passBox']
		. "'";
		$loginres = mysql_query($loginsql);
		$numrows = mysql_num_rows($loginres);
		if($numrows == 1) // Si el usuario existe, verificar contraseña
		{
			$loginrow = mysql_fetch_assoc($loginres);
			session_register("SESS_LOGGEDIN");
			session_register("SESS_USERNAME");
			session_register("SESS_USERID");
			$_SESSION['SESS_LOGGEDIN'] = 1;
			$_SESSION['SESS_USERNAME'] = $loginrow['username'];
			$_SESSION['SESS_USERID'] = $loginrow['id'];
			header("Location: " . $config_basedir);
		}
		else	// De otro modo, retornar a ventana de login.
		{
			header("Location: http://localhost/biomecanica/login.php?error=1");
		}
	} else {
	
	require("header.php");
?>
	<!-- Pagina de login-->
	<h1>Ingreso de Usuarios</h1>
	Por favor ingrese su nombre de usuario y 
	contraseña para ingresar a la aplicacion. 
	
	<p><strong>El Usuario es: joaquin</strong></p>
	<p><strong>La Contraseña es: biomec</strong></p>

</br>
<?php // En caso de Error
	if($_GET['error'] == 1) {
		echo "<strong>Usuario/Contraseña Incorrecta</strong>";
	}
?>
	<form action="login.php" method="POST">
	<table>
	<tr>
		<td>Username</td>
		<td><input type="textbox" name="userBox">
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="passBox">
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="Log in"></td>
	</tr>
	</table>
</form>
<?php
}
require("footer.php");
?>