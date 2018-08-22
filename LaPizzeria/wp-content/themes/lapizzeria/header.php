<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.jpg">
	<meta name="apple-mobile-web-app-title" content="La Pizzeria">
	
	<meta charset="utf-8">
	<?php wp_head();?>
</head>
<body <?php body_class(); ?> >

	<header class="encabezado-sitio">
		<div class="contenedor">
			<div class="logo">
				<a href="<?php echo esc_url(home_url('/') )?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" class="logotipo">
				</a>
			</div> <!--logo -->

			<div class="informacion-encabezado"> 
				<div class="redes-sociales">
					<?php
						$args = array(
							'theme_location' => 'social-menu',
							'container' => 'nav',
							'container_class' => 'sociales',
							'container_id' => 'sociales',
							'link_before' => '<span class="sr-text">',
							'link_after' => '</span>'
							 );
						wp_nav_menu( $args );
					?>
				</div><!-- redes socialies -->

				<div class="direccion">

					<p> <?php echo esc_html( get_option('lapizzeria_direccion') );?></p>
					<p> Telefono: <?php echo esc_html( get_option('lapizzeria_telefono') );?></p>
				
				</div>  <!-- direccion -->
			</div> 

			

		</div> <!--contenedor-->
	</header>

	<div class="menu-principal">

		<div class="mobile-menu">
			<a href="#" class="mobile"><i class="fa-bars"></i>Menu</a> 
			
		</div>
		<dir class="contenedor navegacion">
			<?php 
				$args = array(
					'theme_location' => 'header-menu',
					'container' => 'nav',
					'container_class' => 'menu-sitio'
				);

				wp_nav_menu($args);
			?>
		</dir>
	</div>

	
		
	
