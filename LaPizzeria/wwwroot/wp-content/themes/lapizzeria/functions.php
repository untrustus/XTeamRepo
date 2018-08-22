<?php

// Tablas personalizadas y otras funciones
require get_template_directory() . '/inc/database.php';

// Funciones para las reservaciones
require get_template_directory() . '/inc/reservaciones.php';

// Crear opciones para el template
require get_template_directory() . '/inc/opciones.php';

function lapizzeria_setup()
{

	add_theme_support( 'post-thumbnails' );
	add_image_size('nosotros', 437, 291, true);
	add_image_size('especialidades', 768, 515, true);
	add_image_size('especialidades_portrait', 435, 526, true);
	update_option( 'thumbnail_size_w', 253);
	update_option( 'thumbnail_size_h', 164);
}

add_action( 'after_setup_theme', 'lapizzeria_setup' );

function lapizzeria_styles()
{
	//Registrar los estilos
	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.0');

	wp_register_style('fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', array('normalize'), '5.2.0');

	wp_register_style('brands', get_template_directory_uri() . '/css/brands.min.css', array('normalize'), '5.2.0');

	wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '10.0');

	wp_register_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', array(), '1.0.0');

	wp_register_style( 'fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array('normalize'), '1.0.0');

	//Llamar a los estilos
	wp_enqueue_style('normalize');
	wp_enqueue_style('brands');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('style');
	wp_enqueue_style('fluidboxcss');



}

function lapizzeria_scripts()
{
	//Registrar Js
	wp_register_script( 'scripts', get_template_directory_uri().'/js/scripts.js', array(), '2.0.0', true);
	wp_register_script( 'fluidboxjs', get_template_directory_uri().'/js/jquery.fluidbox.min.js', array(), '2.0.0', true);

	wp_register_script('debounce', '//cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js', array('jquery'), '2.0.0', true );

	$apikey = esc_html(get_option( 'lapizzeria_api_key' ));
	wp_register_script('maps', "https://maps.googleapis.com/maps/api/js?key=".($apikey)."&callback=initMap", array(), '', true );

	wp_enqueue_script('jquery');
	wp_enqueue_script('scripts');
	wp_enqueue_script('fluidboxjs');
	wp_enqueue_script('debounce');
	wp_enqueue_script('maps');

	// Pasar variables de PHP a JavaScript.
	wp_localize_script( 
		'scripts', 
		'opciones', 
		array(
		'latitud' => get_option( 'lapizzeria_latitud' ),
		'longitud' => get_option( 'lapizzeria_longitud' ),
		'zoom' => get_option( 'lapizzeria_zoom' )
	) );
}

// Agregar async y deffer 

function agregrar_async_defer($tag, $handle)
{
	if('maps' !== $handle)
		return $tag;
	return str_replace(' src', ' async="async" defer="defer" src', $tag);
}
add_filter( 'script_loader_tag', 'agregrar_async_defer', 10, 2 );

add_action('wp_enqueue_scripts', 'lapizzeria_styles');
add_action('wp_enqueue_scripts', 'lapizzeria_scripts');

function lapizzeria_menus(){
	register_nav_menus(array(
		'header-menu'=> __('Header Menu', 'lapizzeria'),
		'social-menu'=> __('Social Menu', 'lapizzeria')
	));

}

add_action('init', 'lapizzeria_menus');

add_action( 'init', 'lapizzeria_especialidades' );
function lapizzeria_especialidades() {
	$labels = array(
		'name'               => _x( 'Pizzas', 'lapizzeria' ),
		'singular_name'      => _x( 'Pizzas', 'post type singular name', 'lapizzeria' ),
		'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria' ),
		'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
		'add_new'            => _x( 'Add New', 'book', 'lapizzeria' ),
		'add_new_item'       => __( 'Add New Pizza', 'lapizzeria' ),
		'new_item'           => __( 'New Pizzas', 'lapizzeria' ),
		'edit_item'          => __( 'Edit Pizzas', 'lapizzeria' ),
		'view_item'          => __( 'View Pizzas', 'lapizzeria' ),
		'all_items'          => __( 'All Pizzas', 'lapizzeria' ),
		'search_items'       => __( 'Search Pizzas', 'lapizzeria' ),
		'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria' ),
		'not_found'          => __( 'No Pizzases found.', 'lapizzeria' ),
		'not_found_in_trash' => __( 'No Pizzases found in Trash.', 'lapizzeria' )
	);

	$args = array(
		'labels'             => $labels,
    	'description'        => __( 'Description.', 'lapizzeria' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'especialidades' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'          => array( 'category' ),
	);

	register_post_type( 'especialidades', $args );
}

// Widgets

function lapizzeria_widgets(){
	register_sidebar(array(
		'name' 		=> 'Blog Sidebar',
		'id' 		=> 'blog_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>' 
		));
}

add_action('widgets_init', 'lapizzeria_widgets');

// Advanced Custom Flieds

define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_especialidades',
		'title' => 'Especialidades',
		'fields' => array (
			array (
				'key' => 'field_5b6f23438d927',
				'label' => 'Precio',
				'name' => 'precio',
				'type' => 'text',
				'instructions' => 'Añada precio del platillo',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'especialidades',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_principal',
		'title' => 'Principal',
		'fields' => array (
			array (
				'key' => 'field_5b70f1e05ff8b',
				'label' => 'Contenido',
				'name' => 'contenido',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega la descripción',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5b70f20b5ff8c',
				'label' => 'Imagen',
				'name' => 'imagen',
				'type' => 'image',
				'instructions' => 'Agrega imagen',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '15',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_sobre-nosotros',
		'title' => 'Sobre Nosotros',
		'fields' => array (
			array (
				'key' => 'field_5b6f0b73282c6',
				'label' => 'Imagen_1',
				'name' => 'imagen_1',
				'type' => 'image',
				'instructions' => 'Suba una imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5b6f0be5282c9',
				'label' => 'Descripcion_1',
				'name' => 'descripcion_1',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega aquí la descripcion',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5b6f0bc5282c7',
				'label' => 'Imagen_2',
				'name' => 'imagen_2',
				'type' => 'image',
				'instructions' => 'Suba una imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5b6f0c31282ca',
				'label' => 'Descripcion_2',
				'name' => 'descripcion_2',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega aquí la descripcion',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5b6f0bd7282c8',
				'label' => 'Imagen_3',
				'name' => 'imagen_3',
				'type' => 'image',
				'instructions' => 'Suba una imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5b6f0c39282cb',
				'label' => 'Descripcion_3',
				'name' => 'descripcion_3',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega aquí la descripcion',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '17',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>

