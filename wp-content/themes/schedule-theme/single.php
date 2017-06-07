<?php require_once('pre-header.php'); ?>
<?php /* Template Name: Job Detail Template */ get_header(); ?>
<div class="container">

	<main role="main">
	<!-- section -->
	<section>
	<h1><?php the_title(); ?></h1>
	<?php include_once('input-form.php'); ?>
	<?php if (have_posts()) : the_post(); ?>
		<?php /*?><h1><?php the_title(); ?></h1>	
		<form action="" id="primaryPostForm" method="POST">
	  		<div class="row">
			  <div class="form-group col-md-4">
				<label for="postTitle"><?php _e('Job Number', 'framework') ?></label>
				<input type="text" class="form-control required" name="postTitle" id="postTitle"  aria-describedby="text1Help" value="<?php the_title(); ?>">
				<small id="text1Help" class="form-text text-muted">Muted text under the input field showing some information.</small>
			  </div>
			  <div class="form-group col-md-4">
				<label for="textInput2">Text Input 2</label>
				<input type="text" class="form-control" id="textInput2" name="textInput2" placeholder="Enter text here" value="<?php echo get_post_meta(get_the_ID(), 'text_input2', true); ?>">
			  </div>
			  <div class="form-group col-md-4">
				<label for="exampleSelect1">Example select</label>
				<select class="form-control" id="exampleSelect1" name="exampleSelect1">
				  <option selected="selected"><?php echo get_post_meta(get_the_ID(), 'example_select1', true); ?></option>	
				  <option>1</option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				</select>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group col-md-4">		
				<label for="postContent"><?php _e('Text Area', 'framework') ?></label>
				<input type="text" id="textInput3" name="textInput3" class="form-control" placeholder="Enter text here" value="<?php echo get_post_meta(get_the_ID(), 'text_input3', true); ?>">
			  </div>
			  <div class="form-group col-md-4">		
				<label for="postContent"><?php _e('Text Area', 'framework') ?></label>
				<input type="text" id="textInput4" name="textInput4" class="form-control" placeholder="Enter text here" value="<?php echo get_post_meta(get_the_ID(), 'text_input4', true); ?>">
			  </div>
			  <div class="form-group col-md-4">
				<label for="exampleSelect2">Example select</label>
				<select class="form-control" id="exampleSelect2" name="exampleSelect2">
			  	  <option selected="selected"><?php echo get_post_meta(get_the_ID(), 'example_select2', true); ?></option>
				  <option>1</option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				</select>
			  </div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php if ( $postTitleError != '' ) { ?>
						<span class="error"><?php echo $postTitleError; ?></span>
						<div class="clearfix"></div>
					<?php } ?>
					<input type="hidden" name="submitted" id="submitted" value="true" />
					<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
				  <button type="submit" class="btn btn-primary"><?php _e('Update Job', 'framework') ?></button>
				</div>
			</div>
		</form><?php */?>
		
	

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

</div>

<?php get_footer(); ?>
