<?php 

// Inicializa la creacion de las tablas nuevas

function lapizzeria_database()
{
	// $wpdb nos da los metodos para trabajar con tablas
	global $wpdb;
	// Agregamos una version
	global $lapizzeria_dbversion;
	$lapizzeria_dbversion = '1.0';
	// Obtemenos el prefijo
	$tabla = $wpdb->prefix . 'reservaciones';
	//Obtenemos el collatiob de la instalacion
	$charset_collate = $wpdb->get_charset_collate();
	// Agregamos la estructura de la base de datos
	$sql = "CREATE TABLE $tabla (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			nombre varchar(50) NOT NULL,
			fecha datetime NOT NULL,
			correo varchar(50) DEFAULT '' NOT NULL,
			telefono varchar(10) NOT NULL,
			mensaje longtext NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate; ";

		// Se necesita dbDelta para ejecutar el SQL y esta en la siguiente direccion
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta( $sql);

		// Agregamos la version de la base de datos para compararla con futuras actualziacion
		add_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );

		// ACTUALIZAR EN CASO DE SER NECESARIO

		$version_actual = get_option('lapizzeria_dbversion');
		// Comparamos ambas versiones
		if($lapizzeria_dbversion != $version_actual)
		{
			$tabla = $wpdb->prefix . 'reservaciones';
			//Aqui realizas actualizaciones
			$sql = "CREATE TABLE $tabla (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			nombre varchar(50) NOT NULL,
			fecha datetime NOT NULL,
			correo varchar(50) DEFAULT '' NOT NULL,
			telefono varchar(10) NOT NULL,
			mensaje longtext NOT NULL,
			PRIMARY KEY (id)
			) $charset_collate; ";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta( $sql);
			//Actualizamos a la versión actual en caso de que haya una nueva
			update_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );
		}
}

add_action( 'after_setup_theme', 'lapizzeria_database' );

// Funcion para comprobar que la versión instalada es igual a la base de datos nueva.
function lapizzeria_revisar(){
	global $lapizzeria_dbversion;
	if(get_site_option( 'lapizzeria_dbversion') != $lapizzeria_dbversion)
	{
		lapizzeria_database();
	}
}

add_action( 'plugins_loaded', 'lapizzeria_revisar' );

?>