<?php
// add additional fields here...
$field_key = array(
					'customer' => 'customer',
					'job_status' => 'jobStatus',
					'sales_rep' => 'salesRep',
					'csr' => 'csr',
					'planner' => 'planner',
					'cop' => 'cop',
					'cop_time' => 'copTime',
					'job_description' => 'jobDescription'
				  );

$form_colms = array ();						
	$form_colms[]=array("headname"=>"Form #","classname"=>"table-md", "inputtype"=>"text","fieldname"=>"form_name");
	$form_colms[]=array("headname"=>"Front", "classname"=>"table-lg", "inputtype"=>"text","fieldname"=>"form_front");
	$form_colms[]=array("headname"=>"P", "classname"=>"table-sm", "inputtype"=>"checkbox","fieldname"=>"form_front_p");
	$form_colms[]=array("headname"=>"Back", "classname"=>"table-lg", "inputtype"=>"text","fieldname"=>"form_back");
	$form_colms[]=array("headname"=>"P", "classname"=>"table-sm", "inputtype"=>"checkbox","fieldname"=>"form_back_p");
	$form_colms[]=array("headname"=>"Sheets to Press", "classname"=>"table-md", "inputtype"=>"text","fieldname"=>"form_sheets_to_press");
	$form_colms[]=array("headname"=>"Stock Size", "classname"=>"table-md", "inputtype"=>"text","fieldname"=>"form_stock_size");
	$form_colms[]=array("headname"=>"Form Type", "classname"=>"table-md", "inputtype"=>"text","fieldname"=>"form_form_type");
	$form_colms[]=array("headname"=>"Stock", "classname"=>"table-lg", "inputtype"=>"text","fieldname"=>"form_stock");	

if (isset($_POST['firstSubmit'])) {
	if ( basename(get_permalink()) == "add-a-job" ) {
		// Post title
		$post_information = array(
			'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
			'post_content' => $_POST['postContent'],
			'post_type' => 'post',
			'post_status' => 'publish'
		);

		$post_id = wp_insert_post( $post_information );
		
		
		
	}  else {
		// Post title
		$post_information = array(
			'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
			'post_content' => $_POST['postContent'],
			'post_type' => 'post',
			'post_status' => 'publish'
		);

		$post_id = wp_update_post( $post_information );
		

	}

	foreach ( $field_key as $database_key => $form_key ) {
		update_post_meta ( $post_id, $database_key , $_POST[$form_key] );
	}


	foreach($_POST as $k=>$v){
		foreach($form_colms as $col){
			$pattern="/^".$col['fieldname']."_\d/";
			if(preg_match($pattern,$k)){
				update_post_meta($post_id,$k,$v);
			}
		}
	}
	
} elseif (isset($_POST['secondSubmit'])) {
//	echo $_POST['secondSubmit'] . "this is correct" . "<br />";
//	echo var_dump($_POST);
	
	$p = intval($_POST['secondSubmit']);
	
	foreach ( $field_key as $database_key => $form_key ) {
		update_post_meta ( $p, $database_key , $_POST[$form_key] );
	}


	foreach($_POST as $k=>$v){
		foreach($form_colms as $col){
			$pattern="/^".$col['fieldname']."_\d/";
			if(preg_match($pattern,$k)){
				update_post_meta($p,$k,$v);
			}
		}
	}
}

//$args = array(
//		'post_type' => 'post',
//		'post_status' => 'publish',
//			);
//// The Query
//$the_query = new WP_Query( $args );
// 
//// The Loop
//
//
//    while ( $the_query->have_posts() ) {
//        $the_query->the_post();
//        echo the_ID() . '<br />';
//    }
//
//
///* Restore original Post Data */
//wp_reset_postdata();
//	

	

	
	
	
//	echo "POST value for form_front_p_0 is ".$_POST["form_front_p_0"];

	// redirect
if ( basename(get_permalink()) != "scheduler" ) {
	if ( $post_id ) {
		wp_redirect( get_permalink( $post_id ) );
		exit;
		
	}
}
?>
