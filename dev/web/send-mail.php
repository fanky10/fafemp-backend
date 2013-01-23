<?php

	// site owner infos
	$email_to = 'info@fafemp.org';
	//$success_message = "Mensaje enviado correctamente.";
	$site_name = 'Foro Argentino de Facultades y Escuelas de Medicina Públicas';

	// contact form fields
	$nombre = trim( $_POST['nombre'] );
	$telefono = trim( $_POST['telefono'] );
	$ciudad = trim( $_POST['ciudad'] );
	$zip = trim( $_POST['zip'] );
	$email = trim( $_POST['email'] );
	$mensaje = trim( $_POST['mensaje'] );
	$submitted = $_POST['submitted'];

	// contact form submitted
	if ( isset( $submitted ) )
	{
		// check for error
		if ( $nombre === '' )
		{
			$nombre_empty = true;
			$error = true;
		}
		elseif ( $telefono === '' )
		{
			$telefono_empty = true;
			$error = true;
		}
		elseif ( $ciudad === '' )
		{
			$ciudadempty = true;
			$error = true;
		}
		elseif ( $zip === '' )
		{
			$zip_empty = true;
			$error = true;
		}
		elseif ( $email === '' )
		{
			$email_empty = true;
			$error = true;
		}
		elseif ($mensaje === '')
		{
			$mensaje_empty = true;
			$error = true;
		}
		// end check for error
		
		// error
		if ( isset( $error ) )
		{
			header("Location: contacto-no-enviado.php");
		}
		// end error
		
		// no error send mail
		if ( ! isset($error) )
		{
			$subject = 'Mensaje desde el Sitio ' . $site_name . ' Online';
			
			$body = "Nombre: $nombre \n\nTelefono: $telefono \n\nCiudad: $ciudad \n\nZip: $zip \n\nEmail: $email \n\nMensaje: $mensaje";
			
			$headers = 'From: ' . $nombre . ' <' . $email . '> ' . "\r\n" . 'Reply-To: ' . $email;
			
			mail( $email_to, $subject, $body, $headers );
			
			//echo '<div class="alert alert-success contact-alert"><strong>ENVIADO! </strong>' . $success_message . '</div>';
			header("Location: contacto-enviado.php");
		}
		// end no error send mail
		
	}
	// end contact form submitted
	
?>