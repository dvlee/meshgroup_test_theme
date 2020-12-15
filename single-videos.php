<?php get_header() ?>

<div class="block block-details">
	<div class="container">

		<div class="block__video">
			<?php 
			$post_id = get_the_ID();
			$video_url = get_post_meta( $post_id, 'video_url', true);
			$video_id = explode("?v=", $video_url)[1];
			?>
			<iframe width="100%" height="420" src="https://www.youtube.com/embed/<?php echo $video_id ?>" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen></iframe>
		</div>

		<div class="block__header">
			<h1><?php the_title() ?></h1>
		</div>

		<div class="block__content">
			<?php the_content() ?>
		</div>
	
	</div>
</div>

<?php get_footer() ?>