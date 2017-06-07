<?php /* Template Name: Shipped Template */ get_header(); ?>

<div class="container">
	
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
 	<div class="padding-top">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Job Number</th>
					<th>Date Updated</th>
					<th>Customer</th>
					<th>Sales Rep</th>
					<th>CSR</th>
					<th>Planner</th>
					<th>Job Status</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Job Number</th>
					<th>Date Updated</th>
					<th>Customer</th>
					<th>Sales Rep</th>
					<th>CSR</th>
					<th>Planner</th>
					<th>Job Status</th>
				</tr>
			</tfoot>
			<tbody>
		<?php query_posts($args); ?>    
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<?php if ((get_post_meta(get_the_ID(), 'job_status', true)) == "Shipped") { ?>
					<tr id="post-<?php the_ID(); ?>" >
						<td><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></td>
						<td><?php echo get_the_time('n/j/Y \a\t g:ia', get_the_ID()); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'customer', true); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'sales_rep', true); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'csr', true); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'planner', true); ?></td>
						<td><?php echo get_post_meta(get_the_ID(), 'job_status', true); ?></td>
					</tr>
			<?php	} ?>			
		<?php endwhile; ?>
		<?php wp_reset_query();?>
			</tbody>
		</table>
	</div>
    
<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
	
</div>

</div>

<?php get_footer(); ?>
