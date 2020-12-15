<?php 
/**
 * Template Name: Front page with posts and videos
 */
?>

<?php get_header() ?>
<?php 
$posts_args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 6,
	'orderby' => 'date',
	'order' => 'DESC'
);
$posts_query = new WP_Query($posts_args);

if ($posts_query->have_posts()):
?>
<div class="block block--posts pt-3 pb-5 mb-5">
	<div class="container">

		<h1 class="block__title">Latest posts</h1>

		<div class="block__content row">
			<?php while($posts_query->have_posts()): $posts_query->the_post(); ?>
			<div class="col-lg-4 col-sm-6">
				<?php echo get_template_part('partials/posts-list-item') ?>
			</div>
			<?php endwhile; ?>
		</div>

		<div class="block__footer text-center">
			<a href="<?php echo get_post_type_archive_link('post') ?>" class="btn btn-primary">View All</a>
		</div>

	</div>
</div>
<?php 
endif;
wp_reset_postdata();
?>


<?php 
$videos_args = array(
	'post_type' => 'videos',
	'post_status' => 'publish',
	'posts_per_page' => 4,
	'order' => 'ASC',
	'orderby' => 'meta_value_num',
	'meta_key' => 'video_order',
	'meta_query' => [
		[ 'key' => 'video_order' ]
	]
);
$videos_query = new WP_Query($videos_args);

if ($videos_query->have_posts()):
?>
<div class="block block--videos">
	<div class="container">

		<h1 class="block__title">Videos</h1>

		<div class="block__content row">
			<?php while($videos_query->have_posts()): $videos_query->the_post(); ?>
			<div class="col-lg-3 col-sm-6">
				<?php echo get_template_part('partials/videos-list-item') ?>
			</div>
			<?php endwhile; ?>
		</div>

		<div class="block__footer text-center">
			<a href="<?php echo get_post_type_archive_link('videos') ?>" class="btn btn-primary">View All</a>
		</div>

	</div>
</div>
<?php 
endif;
wp_reset_postdata();
?>

<?php get_footer() ?>