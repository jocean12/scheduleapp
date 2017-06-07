<?php get_header(); ?>


<div class="header-bg">
	<div class="container">	
		<div class="col-md-12">
			<div class="jumbotron">
			  <h1>New Brilliant Scheduling Tool</h1>
			  <p>This is a brand new Brilliant scheduling tool for internal use.  Schedule and track jobs as they go through their process.  For more information on how to use this tool click the button below.  </p>
			  <p><a class="btn btn-primary btn-lg" href="/how-to/" role="button">Learn more</a></p>
			</div>
		</div>
	</div>
</div>
<div class="container">	
<div class="col-md-12">

	<main role="main">
	<!-- section -->
	<section>
	
<?php /*?>	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- /post title -->
			<p><?php echo get_post_meta(get_the_ID(), 'text_input3', true); ?></p>
			<!-- post details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
			
			<!-- /post details -->

			<?php the_content(); // Dynamic Content ?>
			
			
		</article>
		<!-- /article -->

	<?php endwhile; ?>
	
	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>
	
	<?php get_template_part('pagination'); ?><?php */?>
	<?php get_template_part('loop'); ?>
	
	</section>
	<!-- /section -->
	</main>
	
</div>

</div>

<?php get_footer(); ?>
