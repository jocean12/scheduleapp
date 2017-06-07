 <?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<li class="panel ui-state-default"><button class="btn btn-sm btn-warning"><i class="fa fa-arrows" aria-hidden="true"></i></button> <?php the_title(); ?><a data-toggle="collapse" class="btn btn-sm btn-info pull-right" data-parent="#accordion1" href="#link-<?php the_ID(); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
	<div id="link-<?php the_ID(); ?>" class="collapse">
		Subtext
	</div>
</li>
<?php endwhile; ?>

<?php else: ?>

<!-- article -->
<li>
	<?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?>
</li>
<!-- /article -->

<?php endif; ?>
