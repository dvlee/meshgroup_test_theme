<div class="card mb-4">
	<div class="card-body">
		<h4 class="card-title text-truncate"><?php the_title() ?></h4>
		<div class="card-text mb-2">
			<?php echo substr(get_the_excerpt(), 0, 90) . '...' ?>
		</div>
		<div class="d-flex justify-content-between align-items-baseline">
			<small class="text-muted"><?php echo get_the_date() ?></small>
			<a href="<?php echo get_permalink() ?>" class="card-link">Read more</a>
		</div>
	</div>
</div>