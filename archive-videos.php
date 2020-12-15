
<?php get_header() ?>

<div class="block block--videos">
	<div class="container">

		<h1 class="block__title">Videos</h1>

		<div class="block__content row mb-5">
			<?php while(have_posts()): the_post(); ?>
			<div class="col-lg-3 col-sm-6">
				<?php echo get_template_part('partials/videos-list-item') ?>
			</div>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination([ 'prev_text' => '<< Prev', 'next_text' => 'Next >>']); ?>

	</div>
</div>

<?php get_footer() ?>