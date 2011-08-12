<?php 
	require("db.php");
	require("functions.php");
	require("header.php");
	
	$foto = $_POST['foto'];
	$nro_doc = $_POST['nro_doc'];
	$podograma = $_POST['podograma'];
	$fecha_txt = $_POST['fecha_txt'];
	$tiempo_txt = $_POST['tiempo_txt'];
	$fecha = $_POST['fecha'];
	$tiempo = $_POST['tiempo'];
	
	if (isset($_POST['fotosubmit']))
	{
		$id = $_POST['id'];
		#Directorio de los archivos
		$target_path = "uploads/";
		
		/* Add the original filename to our target path.  
		Result is "uploads/filename.extension" */
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		$_FILES['uploadedfile']['tmp_name'];  
		
		$target_path = "uploads/";

		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			$foto = basename( $_FILES['uploadedfile']['name']);
			echo $foto;
			if ($foto == $fecha.$tiempo.'1.JPG')
			{
				$sql = "update citas SET
					foto='$foto'
					WHERE nro_cita='$id'";
				mysql_query($sql);
				
				if (@mysql_query($sql)) {
					echo('<p>Se subio correctamente la foto a la cita. </p>');
					printf("<img width=500 src='./uploads/$foto".
					"' alt='La imagen no se encuentra en el directorio /uploads/'>");
				} else {
					echo ('<p>Ocurrio un error al subir la foto de su cita: '.mysql_error().'</p>');
				}
			}
			else {
				echo('<p style="color: red; ">Error: La imagen que intento subir no coincide con la imagen que se le sugirio subir.</p>');
				echo "</br>\n";
				printf("<a class='button' href=\"uploader.php?id=$id\">Volver</a>");
				echo "<br><br></br>\n";	
				require("footer.php");
				exit;
			}
		} else	{
		    echo ('<p style="color: red; "> Ocurrio un error al subir la foto de su cita. Intente de nuevo </p>');
			echo "</br>\n";
			printf("<a class='button' href=\"uploader.php?id=$id\">Volver</a>");
			echo "<br><br></br>\n";	
			require("footer.php");
			exit;
		}
		
		ini_set("memory_limit","500M");
		$myImage = imagecreatefromjpeg( $target_path );
		$myGrey = imagecolorallocate($myImage, 204, 204, 204);
		$myCopyright = @imagecreate(1700, 35)
	    or die("Cannot Initialize new GD image stream");
		$background_color = imagecolorallocate($myCopyright, 255, 245, 245);
		$text_color = imagecolorallocate($myCopyright, 0, 0, 0);
		imagestring($myCopyright, 5, 50, 10,  "fecha: $fecha_txt, tiempo: $tiempo_txt, documento: $nro_doc, codigo: "
			.$fecha.$tiempo.'1', $text_color);
		$destWidth = imagesx($myImage);
		$destHeight = imagesy($myImage);
		$srcWidth = imagesx($myCopyright);
		$srcHeight = imagesy($myCopyright); 
		$destX = ($destWidth - $srcWidth)/2;
	 	$destY = ($destHeight - $srcHeight)/2; 
		imagecopy($myImage, $myCopyright, 0, 0, 0, 0, $srcWidth, $srcHeight);
		$target_path = "uploads/";
		$file_keep = $target_path . $foto;
		imagejpeg($myImage, $file_keep);
		imagedestroy($myImage);
		imagedestroy($myCopyright);
	}
	if (isset($_POST['podosubmit']))
	{
		$id = $_POST['id'];
		#Directorio de los archivos
		$target_path = "uploads/";

		/* Add the original filename to our target path.  
		Result is "uploads/filename.extension" */
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		$_FILES['uploadedfile']['tmp_name'];  
		
		$target_path = "uploads/";

		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

		if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			$podograma = basename( $_FILES['uploadedfile']['name']);
			
			if ($podograma == $fecha.$tiempo.'0.JPG')
			{
				$sql = "update citas SET
					podograma='$podograma'
					WHERE nro_cita='$id'";
				mysql_query($sql);
				
				if (@mysql_query($sql)) {
					echo('<p>Se subio correctamente el podograma a la cita. </p>');
					printf("<img width=500 src='./uploads/$podograma".
					"' alt='La imagen no se encuentra en el directorio /uploads/'>");
				} else {
					echo ('<p>Ocurrio un error al subir el podograma de su cita: '.mysql_error().'</p>');
				}
			}
			else {
				echo('<p style="color: red; ">Error: La imagen que intento subir no coincide con la imagen que se le sugirio subir.</p>');
				echo "</br>\n";
				printf("<a class='button' href=\"uploader.php?id=$id\">Volver</a>");
				echo "<br><br></br>\n";	
				require("footer.php");
				exit;
			}
		} else	{
		    echo ('<p style="color: red; "> Ocurrio un error al subir el podograma de su cita. Intente de nuevo </p>');
			echo "</br>\n";
			printf("<a class='button' href=\"uploader.php?id=$id\">Volver</a>");
			echo "<br><br></br>\n";	
			require("footer.php");
			exit;
		}
		
		ini_set("memory_limit","500M");
		$myImage = imagecreatefromjpeg( $target_path );
		$myGrey = imagecolorallocate($myImage, 204, 204, 204);
		$myCopyright = @imagecreate(1700, 35)
	    or die("Cannot Initialize new GD image stream");
		$background_color = imagecolorallocate($myCopyright, 255, 245, 245);
		$text_color = imagecolorallocate($myCopyright, 0, 0, 0);
		imagestring($myCopyright, 5, 50, 10,  "fecha: $fecha_txt, tiempo: $tiempo_txt, documento: $nro_doc, codigo: "
			.$fecha.$tiempo.'0', $text_color);
		$destWidth = imagesx($myImage);
		$destHeight = imagesy($myImage);
		$srcWidth = imagesx($myCopyright);
		$srcHeight = imagesy($myCopyright); 
		$destX = ($destWidth - $srcWidth)/2;
	 	$destY = ($destHeight - $srcHeight)/2; 
		imagecopy($myImage, $myCopyright, 0, 0, 0, 0, $srcWidth, $srcHeight);
		$target_path = "uploads/";
		$file_keep = $target_path . $podograma;
		imagejpeg($myImage, $file_keep);
		imagedestroy($myImage);
		imagedestroy($myCopyright);
	}

	echo "</br>\n";
	printf("<a class='button' href=\"uploader.php?id=$id\">Volver</a>");
	echo "<br><br></br>\n";	
	require("footer.php");
?>