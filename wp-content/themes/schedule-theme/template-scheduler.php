<?php require_once('pre-header.php'); ?>
<?php /* Template Name: Scheduler Template */ get_header(); ?>
<?php $xl105Order = (get_post_meta(get_the_ID(), "XL105"));
	  $xl106Order = (get_post_meta(get_the_ID(), "XL106"));
	  $sm52Order = (get_post_meta(get_the_ID(), "SM52"));
	  $jobOrder = (get_post_meta(get_the_ID(), "jobsOnHoldWell"));
	  $jobOrderNew = (get_post_meta(get_the_ID(), "newJobsWell"));
?>
<div class="container" id="<?php echo get_the_ID(); ?>">

	<main role="main">
		<!-- section -->
		<section>
			<div class="row">
				<div class="col-md-12">
					<h1><?php the_title();?></h1>
				</div>
			</div>
			<div class="row">
				<div class='col-md-12'>
					<h2>Schedule</h2>
					<ul class="timeBlockUL">
						<li class="timeBlockBtn panel"><button class="btn btn-sm btn-warning moveBtn" title="Drag and Drop to Move"><i class="fa fa-arrows" aria-hidden="true"></i></button> &nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp; <input placeholder="Please choose a date and time." style="width:300px;height:30px;" class="form-control datepicker something2" type="text" /></li>
					</ul>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#XL105" aria-controls="XL105" role="tab" data-toggle="tab">XL-105</a></li>
						<li role="presentation"><a href="#XL106" aria-controls="XL106" role="tab" data-toggle="tab">XL-106</a></li>
						<li role="presentation"><a href="#SM52" aria-controls="SM52" role="tab" data-toggle="tab">SM52</a></li>
					</ul>
					<!-- /Nav tabs -->
					<ul role="tabpanel" id="XL105" class='sortable vertical well-now tab-pane active in'>
						<?php 	
						if($xl105Order[0]){
							foreach ($xl105Order[0] as $key => $value){
								if ($value < 1000000000) {
									include('scheduler-divs.php');
								} else { 
									include('time-block.php');
								} 		
							}
						} else ?>
					</ul>
					<ul role="tabpanel" class="sortable vertical tab-pane well-now" id="XL106">
						<?php 	
						if($xl106Order[0]){
							foreach ($xl106Order[0] as $key => $value){
								if ($value < 1000000000) {
									include('scheduler-divs.php');
								} else { 
									include('time-block.php');
								} 	
							}
						}  else ?>
					</ul>
				  	<ul role="tabpanel" class="sortable vertical tab-pane well-now" id="SM52">
						<?php 	
						if($sm52Order[0]){
							foreach ($sm52Order[0] as $key => $value){
								if ($value < 1000000000) {
									include('scheduler-divs.php');
								} else { 
									include('time-block.php');
								} 		
							}
						} else  ?>				  		
				  	</ul>
				</div>
			</div>
			<div class="row">
				<div class='col-md-12'>
					<h2>Jobs On Hold</h2>
				  <ul id="jobsOnHoldWell" class='sortable vertical well '>
					<?php 		  	
						if($jobOrder[0]){
						  foreach ($jobOrder[0] as $key => $value){
							if ($value == 0){
									echo "";
								}
								elseif ($value < 1000000000) {
									include('scheduler-divs.php');
								}
							}
						}  ?>			
				  </ul>
				</div>
			</div>
			<div class="row">
				<div class='col-md-12'>
					<h2>New Jobs</h2>
					  <ul id="newJobsWell" class="sortable vertical well">
					<?php
//						if($jobOrder[0]==NULL){
//							$combarg = $xl105Order[0];
//						} elseif ($xl105Order[0]==NULL){
//							$combarg = $jobOrder[0];	
//						} else {
//						  	$combarg = array_merge($jobOrder[0], $xl105Order[0]);  	
//						}
						 $combarg = array_merge($jobOrder[0], $xl105Order[0],$xl106Order[0],$sm52Order[0]);
						 $args = array (
									'post_type'=>array('post'),
									'post_status'=>array('publish'),
									'post__not_in'=>$combarg,
									'orderby'=> 'modified',
									);
						  
						  $the_query = new WP_Query( $args ); 
						
						include('newjobs-divs.php');				  
					wp_reset_postdata();
					?>

					</ul>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

</div>

<?php  get_footer(); ?>
