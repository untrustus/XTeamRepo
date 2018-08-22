<?php 
/*
*  Template Name: Especialdiades
*/
?>

<?php get_header(); ?>


	<?php while(have_posts()): the_post(); ?>


		<div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
			<div class="contenido-hero">
				<div class="texto-hero">
					
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</div>

		

	<div class="principal contenedor">
		<main class="texto-centrado contenido-paginas">
			<?php the_content(); ?>
		</main>
	</div>
	<?php endwhile; ?>

	<div class="nuestras-especialidades contenedor">
		<h3 class="texto-rojo">Pizzas</h3>
		<div class="contenedor-grid">
			<?php
			$args = array(
				'post_type' => 'especialidades',
				'post_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'category_name' => 'pizzas'
			);

			$pizzas = new WP_Query($args);
			while($pizzas->have_posts()): $pizzas->the_post();

			?>

			<div class="columnas2-4">
				<?php
						the_post_thumbnail('especialidades');
				?>
				<div class="texto-especialidad">
					<h4><?php the_title(); ?> <span> <?php the_field('precio');?> </span> </h4>
					<?php the_content(); ?>
				</div> <!-- Texto especialidad -->
			</div>

			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		
		<h3 class="texto-rojo">Otros</h3>
		<div class="contenedor-grid">
			<?php
			$args = array(
				'post_type' => 'especialidades',
				'post_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'category_name' => 'otros'
			);

			$pizzas = new WP_Query($args);
			while($pizzas->have_posts()): $pizzas->the_post();

			?>

			<div class="columnas2-4">
				<?php
						the_post_thumbnail('especialidades');
				?>
				<div class="texto-especialidad">
					<h4><?php the_title(); ?> <span> <?php the_field('precio');?> </span> </h4>
					<?php the_content(); ?>
				</div> <!-- Texto especialidad -->
			</div>

			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		
	</div> <!-- Nuestra-especialidades contenedor -->

<?php get_footer(); ?>