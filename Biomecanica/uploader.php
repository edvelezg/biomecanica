<?php 
	require("db.php");
	require("functions.php");
	require("header.php");
	
	if (isset($_GET['id'])) #Accion Subir
	{
		$id = $_GET['id'];
		#sql
		$sql = "SELECT fecha, mom_impresion, podograma, foto, nro_doc FROM citas WHERE nro_cita='$id'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$foto = $row['foto'];
		$nro_doc = $row['nro_doc'];
		$podograma = $row['podograma'];
		$fecha_txt = $row['fecha'];
		$tiempo_txt = $row['mom_impresion'];
		$fecha = substr($row['fecha'], 2, 2).substr($row['fecha'], 5, 2).substr($row['fecha'], 8, 2);
		$tiempo = substr($row['mom_impresion'], 0, 2).substr($row['mom_impresion'], 3, 2);
?>

	<h2>Subir Imagenes</h2>
	<hr>
	</br>
	<!-- Foto -->
	<form enctype="multipart/form-data" action="uploadprocess.php" method="POST">
		<fieldset>
			<legend>Subir Foto</legend>
		<input type="hidden" name="MAX_FILE_SIZE" value="900000" />
		<input type="hidden" name="id" value="<?php echo $id?>" />
		<input type="hidden" name="foto" value="<?php echo $foto?>" />
		<input type="hidden" name="nro_doc" value="<?php echo $nro_doc?>" />
		<input type="hidden" name="podograma" value="<?php echo $podograma?>" />
		<input type="hidden" name="fecha_txt" value="<?php echo $fecha_txt?>" />
		<input type="hidden" name="tiempo_txt" value="<?php echo $tiempo_txt?>" />
		<input type="hidden" name="fecha" value="<?php echo $fecha?>" />
		<input type="hidden" name="tiempo" value="<?php echo $tiempo?>" />
		<?php	
			if (trim($foto) != '')
			{
				printf("<img width=100 class='feature' src='./uploads/$foto"."' alt='La imagen no se encuentra en el directorio /uploads/'>");
			}
			if (trim($foto) == '') {
				printf("<p style=\"color: red; \" class='feature'> NO SE HA SUBIDO IMAGEN </p>");
				echo "<p style=\"color: red; \"> <label>Foto: </label>";
				echo "Favor subir el archivo ".$fecha.$tiempo.'1';
				echo "</p>";
			} else {
				echo "<p> <label>Foto:</label>";
				echo $foto;  
				echo "</p>";	
			}
		?>
		<p>
			<label for="uploadedfile">Escoja el archivo que desea subir:</label>
			<input name="uploadedfile" type="file" />
		</p>
		<input type="submit" name="fotosubmit" value="Subir" />
		</fieldset>
	</form>
	<!-- Podograma -->
	<form enctype="multipart/form-data" action="uploadprocess.php" method="POST">
		<fieldset>
			<legend>Subir Podograma</legend>
		<input type="hidden" name="MAX_FILE_SIZE" value="900000" />
		<input type="hidden" name="id" value="<?php echo $id?>" />
		<input type="hidden" name="foto" value="<?php echo $foto?>" />
		<input type="hidden" name="nro_doc" value="<?php echo $nro_doc?>" />
		<input type="hidden" name="podograma" value="<?php echo $podograma?>" />
		<input type="hidden" name="fecha_txt" value="<?php echo $fecha_txt?>" />
		<input type="hidden" name="tiempo_txt" value="<?php echo $tiempo_txt?>" />
		<input type="hidden" name="fecha" value="<?php echo $fecha?>" />
		<input type="hidden" name="tiempo" value="<?php echo $tiempo?>" />
		<?php
		
			if (trim($podograma) != '')
				printf("<img width=100 class='feature' src='./uploads/$podograma"."' alt='La imagen no se encuentra en el directorio /uploads/'>");
			if (trim($podograma) == '') {
				printf("<p style=\"color: red; \" class='feature'> NO SE HA SUBIDO IMAGEN </p>");
				echo "<p style=\"color: red; \"> <label>Podograma: </label>";
				echo "Favor subir el archivo ".$fecha.$tiempo.'0';
				echo "</p>";
			} else {
				echo "<p> <label>Podograma:</label>";
				echo $podograma;  
				echo "</p>";	
			}
		?>
		<p>
			<label for="uploadedfile">Escoja el archivo que desea subir:</label>
			<input name="uploadedfile" type="file" />
		</p>
		<input type="submit" name="podosubmit" value="Subir" />
		</fieldset>
	</form>

<?php
	}
	/*if (isset($_POST['fotosubmit']))
	{
		$id = $_POST['id'];
		#Directorio de los archivos
		$target_path = "uploads/";
		
		Add the original filename to our target path.  
		Result is "uploads/filename.extension" 
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		$_FILES['uploadedfile']['tmp_name'];  
		
		$target_path = "uploads/";

		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			$foto = basename( $_FILES['uploadedfile']['name']);
			if ($foto == $fecha.$tiempo.'1.JPG')
			{
				$sql = "update citas SET
					foto='$foto'
					WHERE nro_cita='$id'";
				mysql_query($sql);
				
				if (@mysql_query($sql)) {
					echo('<p>Se subio correctamente la foto a la cita. </p>');
				} else {
					echo ('<p>Ocurrio un error al subir la foto de su cita: '.mysql_error().'</p>');
				}
			}
			else {
				echo('<p style="color: red; ">Error: La imagen que intento subir no coincide con la imagen que se le sugirio subir.</p>');
				echo "</br>\n";
				printf("<a class='button' href=\"citas.php?num=$id\">Volver</a>");
				echo "<br><br></br>\n";	
				require("footer.php");
				exit;
			}
		} else	{
		    echo ('<p style="color: red; "> Ocurrio un error al subir la foto de su cita. Intente de nuevo </p>');
			echo "</br>\n";
			printf("<a class='button' href=\"citas.php?num=$id\">Volver</a>");
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

		Add the original filename to our target path.  
		Result is "uploads/filename.extension" 
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
				} else {
					echo ('<p>Ocurrio un error al subir el podograma de su cita: '.mysql_error().'</p>');
				}
			}
			else {
				echo('<p style="color: red; ">Error: La imagen que intento subir no coincide con la imagen que se le sugirio subir.</p>');
				echo "</br>\n";
				printf("<a class='button' href=\"citas.php?num=$id\">Volver</a>");
				echo "<br><br></br>\n";	
				require("footer.php");
				exit;
			}
		} else	{
		    echo ('<p style="color: red; "> Ocurrio un error al subir el podograma de su cita. Intente de nuevo </p>');
			echo "</br>\n";
			printf("<a class='button' href=\"citas.php?num=$id\">Volver</a>");
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
	} */
	echo "</br>\n";
	printf("<a class='button' href=\"citas.php?num=$id\">Volver</a>");
	echo "<br><br></br>\n";	
	require("footer.php");
?>