<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
// enque script
add_action('admin_enqueue_scripts', 'my_admin_scripts');
 
function my_admin_scripts() {
        wp_enqueue_media();
        wp_register_script('jsheehan_seo_script', WP_PLUGIN_URL.'/jsheehan_seo_tags/jsheehan_seo_script.js', array('jquery'));
        wp_enqueue_script('jsheehan_seo_script');
}
// end enque script
 
/** Set Defaults **/
add_option( 'jsheehan_field_1', '' );
add_option( 'jsheehan_field_2', 'website' );
add_option( 'jsheehan_field_3', 'Add Twitter Account' );
 
/** Add Settings Page **/
function jsheehan_settings_menu() {
 
    add_options_page(
    /*1*/   'SEO Settings',
    /*2*/   'SEO Settings',
    /*3*/   'manage_options',
    /*4*/   'jsheehan_settings',
    /*5*/   'jsheehan_settings_page'
    );
 
}
add_action( 'admin_menu', 'jsheehan_settings_menu' );
 

 
/** Settings Page Content **/
function jsheehan_settings_page() {
 
    ?>
 
    <div class="wrap">
        <?php
         
        // Uncomment if this screen isn't added with add_options_page()
        // settings_errors();
         
        ?>
 
        <h2>Global SEO Settings</h2>
        <p>Adjust the global SEO and Open Graph settings</p>
 
        <form method="post" action="options.php">
            <?php
 
            // Output the settings sections.
            do_settings_sections( 'jsheehan_settings' );
 
            // Output the hidden fields, nonce, etc.
            settings_fields( 'jsheehan_settings_group' );
 
            // Submit button.
            submit_button();
 
            ?>
        </form>
    </div>
 
    <?php
}
 
/** Settings Initialization **/
function jsheehan_settings_init() {
 
     /** Setting section 1. **/
    add_settings_section(
    /*1*/   'jsheehan_settings_section_1',
    /*2*/   'Fallback Image for Facebook Open Graph and Twitter sharing',
    /*3*/   'jsheehan_settings_section_1_callback',
    /*4*/   'jsheehan_settings'
    );
     
    // Field 1.
    add_settings_field(
    /*1*/   'jsheehan_field_1',
    /*2*/   'Fallback Image',
    /*3*/   'jsheehan_field_1_input',
    /*4*/   'jsheehan_settings',
    /*5*/   'jsheehan_settings_section_1'
    );
 
    // Register this field with our settings group.
    register_setting( 'jsheehan_settings_group', 'jsheehan_field_1' );
     
   /** Section 2 **/
    add_settings_section(
    /*1*/   'jsheehan_settings_section_2',
    /*2*/   'Other Open Graph and Twitter settings',
    /*3*/   'jsheehan_settings_section_2_callback',
    /*4*/   'jsheehan_settings'
    );
     
    // Field 2.
    add_settings_field(
    /*1*/   'jsheehan_field_2',
    /*2*/   'Open Graph Object Type',
    /*3*/   'jsheehan_field_2_input',
    /*4*/   'jsheehan_settings',
    /*5*/   'jsheehan_settings_section_2'
    );
 
    // Register this field with our settings group.
    register_setting( 'jsheehan_settings_group', 'jsheehan_field_2' ); 
     
    // Field 3.
    add_settings_field(
    /*1*/   'jsheehan_field_3',
    /*2*/   'Twitter User Name(i.e. @myTwitterAccount)',
    /*3*/   'jsheehan_field_3_input',
    /*4*/   'jsheehan_settings',
    /*5*/   'jsheehan_settings_section_2'
    );
 
    // Register this field with our settings group.
    register_setting( 'jsheehan_settings_group', 'jsheehan_field_3' );
}
add_action( 'admin_init', 'jsheehan_settings_init' );
 
function jsheehan_settings_section_1_callback() {
 
    echo( 'The pluing will...<br />1.  Look for the image specified by you per post or page.<br />2. If none found will scan the page for the first image it finds.<br />3. If none found will use the Fallback Image specified here.' );
}
 
function jsheehan_settings_section_2_callback() {
 
    echo( 'An explanation of this section.' );
}


/** Field 1 Input **/
function jsheehan_field_1_input() {
	
//	echo( '<input type="text" name="jsheehan_field_1" id="jsheehan_field_1" value="'. get_option( 'jsheehan_field_1' ) .'" />' );
		$userDefinedImage = get_option('jsheehan_field_1');
	?>
	<label for="upload_image">
		<?php if (get_option('jsheehan_field_1') != null){ ?>
			<img src="<?php echo $userDefinedImage; ?>" style="max-width:200px; width:100%; height:auto;" /><br />
		<?php } ?>
		<input id="jsheehan_field_1" type="text" size="36" name="jsheehan_field_1" value="<?php echo $userDefinedImage; ?>" /> 
		<input id="upload_image_button" class="button" type="button" value="Upload Image" />
		<br />Enter a URL or upload an image <br />
		
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
					$('#jsheehan_field_1').val(attachment.url);
				});

				//Open the uploader dialog
				custom_uploader.open();

			});


		});
		
	</script>
	
	<?php
	
}
 
/** Field 2 Input **/
function jsheehan_field_2_input() {
 
    // This example input will be a dropdown.
    // Available options.
    $options = array(
        'website' => 'Website',
        'profile' => 'Profile',
        'book' => 'Book',
		'article' => 'Article',
    );
     
    // Current setting.
    $current = get_option( 'jsheehan_field_2' );
     
    // Build <select> element.
    $html = '<select id="jsheehan_field_2" name="jsheehan_field_2">';
 
    foreach ( $options as $value => $text )
    {
        $html .= '<option value="'. $value .'"';
 
        // We make sure the current options selected.
        if ( $value == $current ) $html .= ' selected="selected"';
 
        $html .= '>'. $text .'</option>';
    }

    $html .= '</select>';
 
    echo( $html ); 
}
 
/** Field 3 Input **/
function jsheehan_field_3_input() {
 
    // Output the form input, with the current setting as the value.
    echo( '<input type="text" name="jsheehan_field_3" id="jsheehan_field_3" value="'. get_option( 'jsheehan_field_3' ) .'" />' );
}
 