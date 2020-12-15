<?php 
// disable gutenberg
add_filter( 'use_block_editor_for_post', '__return_false' );
// enable Featured image
add_theme_support( 'post-thumbnails', [ 'post', 'videos' ] );

// enable menu
function mtt_nav_menu() {
	register_nav_menu('primary_menu',__( 'Primary Menu' ));
}
add_action( 'init', 'mtt_nav_menu' );;
 
// add class for menu items
function add_menu_link_class($atts, $item, $args)
{
	if (!empty($atts['aria-current'])) $atts['class'] = 'active ';
	$atts['class'] .= 'nav-link';
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

// add custom post type
function mtt_posttypes() {
	register_post_type( 'videos', [
		'labels' => [
			'name' => 'Videos',
			'singulat_name' => 'Video'
		],
		'supports' => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'public' => true,
		'has_archive' => true,
		'rewrite' => [ 'slug' => 'videos' ],
		'show_in_rest' => true
	] );
}
add_action( 'init', 'mtt_posttypes' );

// add custom fields for custom post type
function video_add_meta_box() {
	add_meta_box(
		'videos_meta',
		'Videos Meta',
		'videos_meta_box_callback',
		'videos'
	);
	add_meta_box(
		'videos_meta',
		'Youtube Video',
		'videos_meta_box_callback',
		'videos'
	);
}
add_action( 'add_meta_boxes', 'video_add_meta_box' );

// add inputs on edit page
function videos_meta_box_callback( $post ) {
	$id = $post->ID;

	$value = get_post_meta( $id, 'video_url', true );
	echo '<label for="video_url">Video URL </label>';
	echo '<input type="text" id="video_url" name="video_url" value="' . esc_attr( $value ) . '" size="60" />';
	echo '<hr />';

	$value = get_post_meta( $id, 'video_order', true );
	if ($value === '') $value = '0';
	echo '<label for="video_order">Order position </label>';
	echo '<input type="text" id="video_order" name="video_order" value="' . esc_attr( $value ) . '" size="10" />';
}

// save custom fields
function video_save_meta_box_data( $post_id ) {
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	}
	if ( ! isset( $_POST['video_url'] ) ) return;

	$video_data = sanitize_text_field( $_POST['video_url'] );
	$video_order = sanitize_text_field( $_POST['video_order'] );
	update_post_meta( $post_id, 'video_url', $video_data );
	update_post_meta( $post_id, 'video_order', $video_order );
}
add_action( 'save_post', 'video_save_meta_box_data' );

// customize pagination
add_filter('navigation_markup_template', 'custom_navigation_template', 10, 2 );
function custom_navigation_template( $template, $class ){
	return '
	<nav class="navigation justify-content-center %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

// add 'Order' column in admin list page
add_filter( 'manage_videos_posts_columns', 'smashing_videos_columns' );
function smashing_videos_columns( $columns ) {
	$columns = array(
		'cb' => $columns['cb'],
		'video_order' => __( 'Order' ),
		'title' => __( 'Title' ),
		'date' => __( 'Date' )
	);
	return $columns;
}
// set value for 'Order' column
add_action( 'manage_videos_posts_custom_column', 'videos_column_content', 10, 2 );
function videos_column_content( $column, $post_id ) {
    if ( $column ==='video_order' ) {
		$order = get_post_meta($post_id, 'video_order', true);
		echo intval($order);
	}
}
// set column sortable
add_filter( 'manage_edit-videos_sortable_columns', 'sortable_videos_column' );
function sortable_videos_column( $columns ) {
	$columns['video_order'] = 'video_order';
	return $columns;
}

// sorting posts 
add_action( 'pre_get_posts', 'videos_sort_by_order' );
function videos_sort_by_order( $query ) {
	$posttype = $query->get( 'post_type' );
	$orderby = $query->get( 'orderby' );
	  
	if ( is_admin() ) {
		if ( 'video_order' == $orderby ) {
			$query->set( 'meta_key', 'video_order' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	} else {
		if ( is_archive() && $posttype === 'videos' ) {
			$query->set( 'meta_key', 'video_order' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
		}
	}
}

// set column width
add_action('admin_head', 'my_column_width');
function my_column_width() {
	echo '<style type="text/css">';
	echo '.column-video_order { width:80px !important }';
	echo '</style>';
}




?>