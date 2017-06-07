<?php require_once('pre-header.php'); ?>
<?php /* Template Name: Scheduler Template 2*/ get_header(); ?>
<?php //$xl105Order = (get_post_meta(get_the_ID(), "XL105"));
//	  $xl106Order = (get_post_meta(get_the_ID(), "XL106"));
//	  $sm52Order = (get_post_meta(get_the_ID(), "SM52"));
	  $jobOrder = (get_post_meta(get_the_ID(), "jobsOnHoldWell"));
	  $jobOrderNew = (get_post_meta(get_the_ID(), "newJobsWell"));

	  $scheduleCon=array("XL105","XL106","SM52");
	  $arrmerge=array();

      $pageID=get_the_ID();

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
						<?php
							foreach($scheduleCon as $v){
						?>	
							<li role="presentation"><a href="#<?php echo $v;?>" aria-controls="<?php echo $v;?>" role="tab" data-toggle="tab"><?php echo $v;?></a></li>	
						<?php		
							}
						?>
					</ul>
					<!-- /Nav tabs -->
					<div class="tab-panes">
					<?php
						foreach($scheduleCon as $v){	
					?>
					
						<ul role="tabpanel" class='sortable vertical well-now tab-pane' id="<?php echo $v;?>">
						<?php
			
							$wellIDArray=get_post_meta($pageID,$v);
							
							if($wellIDArray[0]){
									foreach ($wellIDArray[0] as $key => $value){
										//echo "Value varaible: ".$value;
										if ($value < 1000000000) {
											include('scheduler-divs.php');
										} else { 
											include('time-block.php');
										} 
//										echo $value;
									}

								  $arrmerge=array_merge($arrmerge,$wellIDArray[0]);
						  	}	
							
//							echo var_dump($wellIDArray[0]);
						?>
						
						</ul>		
					<?php
						}
					
//						echo var_dump($arrmerge);
					
					?>
					</div>
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
						 $args = array (
									'post_type'=>array('post'),
									'post_status'=>array('publish'),
									'post__not_in'=>$arrmerge,
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
