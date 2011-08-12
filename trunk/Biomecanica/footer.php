<?php // Pie de pagina de la Pagina
	echo "<p class=copyright><i>Todo contenido de este sitio es &copy; de "
		. $config_sitename . "</i></p>";

    $admin_logged_in = ( isset($_SESSION['SESS_ADMINLOGGEDIN']) ) ? $_SESSION['SESS_ADMINLOGGEDIN'] : false;
    if ( $admin_logged_in )
    {
		echo "[<a href='" . $config_basedir . "adminorders.php'>admin</a>]
		[<a href='"
		. $config_basedir
		. "adminlogout.php'>admin logout</a>]";
    }
?>
</div>
</div>
</body>
</html>