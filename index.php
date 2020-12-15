<?php get_header() ?>

<?php if (have_posts()): ?>
<div class="block block--posts pt-3 pb-5 mb-5">
	<div class="container">

		<h1 class="block__title">Posts</h1>

		<div class="block__content row">
			<?php while(have_posts()): the_post(); ?>
			<div class="col-lg-4 col-sm-6">
				<?php echo get_template_part('partials/posts-list-item') ?>
			</div>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination([ 'prev_text' => '<< Prev', 'next_text' => 'Next >>']); ?>

	</div>
</div>
<?php endif; ?>

<?php get_footer() ?>