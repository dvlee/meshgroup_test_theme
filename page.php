<?php get_header() ?>

<div class="block block-details">
	<div class="container">

		<div class="block__header">
			<h1><?php the_title() ?></h1>
		</div>

		<div class="block__content">
			<?php the_content() ?>
		</div>
	
	</div>
</div>

<?php get_footer() ?>