<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'jsheehan_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'jsheehan_post_meta_boxes_setup' );

/* Meta box setup function. */
function jsheehan_post_meta_boxes_setup() {

  	/* Add meta boxes on the 'add_meta_boxes' hook. */
  	add_action( 'add_meta_boxes', 'jsheehan_add_post_meta_boxes' );
	
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'jsheehan_save_post_class_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function jsheehan_add_post_meta_boxes() {

  add_meta_box(
    'jsheehan-post-class',      // Unique ID
    esc_html__( 'SEO and Open Graph Settings' ),    // Title
    'jsheehan_post_class_meta_box',   // Callback function
     array('page', 'post'),         // Admin page and post
    'normal',         // Context
    'default'         // Priority
  );
}

/* Display the post meta box. */
function jsheehan_post_class_meta_box( $object, $box ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'jsheehan_post_class_nonce' ); ?>

	  <p>
		<label for="jsheehan-post-class"><?php _e( "Add a Custom Title otherwise the Site Title will be used (Settings > General > Site Title)" ); ?></label>
		<br />
		<input class="widefat" type="text" name="jsheehan-post-class" id="jsheehan-post-class" value="<?php echo esc_attr( get_post_meta( $object->ID, 'jsheehan_post_class', true ) ); ?>" size="30" style="max-width:200px;" />
	  </p>
  <?php $userDescription = get_post_meta( $object->ID, 'jsheehan-description', true ) ; ?>
  	<p>
		<label for="jsheehan-description"><?php _e( "Add a custom short description otherwise the Site Tagline will be used (Settings > General > Tagline)" ); ?></label>
		<br />
		<textarea type="text" name="jsheehan-description" id="jsheehan-description" value="Something" size="30" rows="2" ><?php echo $userDescription ?></textarea>
	</p>
  
<?php 
														
//  image section
	$userImage = get_post_meta( $object->ID, 'jsheehan_user_image', true);
	?>
<strong>Open Graph Image</strong><br />
<p>
The pluing will...<br />
	<ol>
		<li>Look for the image specified below.</li>
		<li>If no image is specified it will scan the page for the first image it finds.</li>
		<li>If none found it will use the Fallback Image specified under (Settings > SEO Settings > Fallback Image).</li>
	</ol>
</p>
	<label for="upload_image">
		<?php if (get_post_meta( $object->ID, 'jsheehan_user_image', true) != null){ ?>
			<img src="<?php echo $userImage; ?>" style="max-width:300px; width:100%; height:auto;" /><br />
		<?php } ?>
		<input id="jsheehan_user_image" type="text" size="36" name="jsheehan_user_image" value="<?php echo $userImage; ?>" /> 
		<input id="upload_image_button" class="button" type="button" value="Upload Image" />
		<br />Enter a URL or upload an image to override default Open Graph Image<br />
		
	</label>
	
	<script>
	
		jQuery(document).ready(function($){
 
 
			var custom_uploader;


			$('#upload_image_button').click(function(e) {

				e.preventDefault();

				//If the uploader object has already been created, reopen the dialog
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}

				//Extend the wp.media object
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: false
				});

				//When a file is selected, grab the URL and set it as the text field's value
				custom_uploader.on('select', function() {
					attachment = custom_uploader.state().get('selection').first().toJSON();
					$('#jsheehan_user_image').val(attachment.url);
				});

				//Open the uploader dialog
				custom_uploader.open();

			});


		});
		
	</script>
	
	<?php												
//  end section end
														
													
}



/* Save the meta box's post metadata. */
function jsheehan_save_post_class_meta( $post_id, $post ) {

  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['jsheehan_post_class_nonce'] ) || !wp_verify_nonce( $_POST['jsheehan_post_class_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  /* Get the posted data and sanitize it for use as a text field. */
  $new_meta_value = ( isset( $_POST['jsheehan-post-class'] ) ? sanitize_text_field( $_POST['jsheehan-post-class'] ) : '' );
	$new_meta_value2 = ( isset( $_POST['jsheehan_user_image'] ) ? sanitize_text_field( $_POST['jsheehan_user_image'] ) : '' );
	$new_meta_value3 = ( isset( $_POST['jsheehan-description'] ) ? sanitize_text_field( $_POST['jsheehan-description'] ) : '' );

  /* Get the meta key. */
  $meta_key = 'jsheehan_post_class';
	$meta_key2 = 'jsheehan_user_image';
	$meta_key3 = 'jsheehan-description';

  /* Get the meta value of the custom field key. */
  $meta_value = get_post_meta( $post_id, $meta_key, true );
	$meta_value2 = get_post_meta( $post_id, $meta_key2, true );
	$meta_value3 = get_post_meta( $post_id, $meta_key3, true );
	

  /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );

  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );

  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
	
	
	/* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value2 && '' == $meta_value2 )
    add_post_meta( $post_id, $meta_key2, $new_meta_value2, true );

  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value2 && $new_meta_value2 != $meta_value2 )
    update_post_meta( $post_id, $meta_key2, $new_meta_value2 );

  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value2 && $meta_value2 )
    delete_post_meta( $post_id, $meta_key2, $meta_value2 );
	
	
	/* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value3 && '' == $meta_value3 )
    add_post_meta( $post_id, $meta_key3, $new_meta_value3, true );

  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value3 && $new_meta_value3 != $meta_value3 )
    update_post_meta( $post_id, $meta_key3, $new_meta_value3 );

  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value3 && $meta_value3 )
    delete_post_meta( $post_id, $meta_key3, $meta_value3 );
}