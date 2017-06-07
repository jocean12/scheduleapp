		
 		 <?php $data = get_post_meta(get_the_ID()); 
//				echo var_dump($data);
//				echo $data['customer'][0];
?>
 		<input type="hidden" value="<?php echo get_the_ID(); ?>" id="postID" />
  		<form action="" id="primaryPostForm" method="POST">
	  		<div class="row">
	  		<div class="form-group col-md-4 showOnScheduler">
				<h1><?php the_title(); ?></h1>
			</div>
			  <div class="form-group col-md-4 showOnAll">
				<label for="postTitle"><?php _e('Job Number', 'framework') ?></label>
				<input type="text" class="form-control required" name="postTitle" id="postTitle"  aria-describedby="text1Help" value="<?php if (get_the_title() == "Add a Job") { echo " "; } else { echo get_the_title(); } ?>">
				<small id="text1Help" class="form-text text-muted">This is a required field.</small>
			  </div>
			  <div class="form-group col-md-4">
				<label for="customer">Customer</label>
				<input type="text" class="form-control" id="customer" name="customer" placeholder="Enter Customer's Name" value="<?php echo $data['customer'][0]; ?>">
			  </div>
			  <div class="form-group col-md-4">
				<label for="jobStatus">Job Status</label>
				<select class="form-control" id="jobStatus" name="jobStatus">
				  <option selected="selected"><?php echo $data['job_status'][0]; ?></option>	
				  <option>New</option>
				  <option>Proof Out</option>
				  <option>Approved</option>
				  <option>Plated</option>
				  <option>Printed</option>
				  <option>Shipped</option>
				</select>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group col-md-4">		
				<label for="salesRep"><?php _e('Sales Rep', 'framework') ?></label>
				<input type="text" id="salesRep" name="salesRep" class="form-control" placeholder="Enter Sales Rep's Name" value="<?php echo $data['sales_rep'][0]; ?>">
			  </div>
			  <div class="form-group col-md-4">		
				<label for="csr"><?php _e('CSR', 'framework') ?></label>
				<input type="text" id="csr" name="csr" class="form-control" placeholder="Enter CSR's Name" value="<?php echo $data['csr'][0]; ?>">
			  </div>
			  <div class="form-group col-md-4">
				<label for="planner">Planner</label>
				<input list="planner" class="form-control" name="planner" value="<?php echo $data['planner'][0]; ?>">
		  	  		<datalist  id="planner">
					  <option value="Ann">
					  <option value="Lufei">
					  <option value="Patty">
					  <option value="Allen">
					  <option value="Bob Britt">
				  </datalist>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group col-md-1">
				  <label for="cop">COP</label>
				<?php 
					if ($data['cop'][0]==1) {$isChecked="checked";}
				?>
			    <input type="hidden" value="0" name="cop">
			    <input id="cop" type="checkbox" value="1" name="cop" <?php echo $isChecked; ?>>
			  </div>
			  <div class="form-group col-md-2">
				 <label for="copTime">COP Time</label>
				 <input type="text" id="copTime" name="copTime" class="form-control" placeholder="00:00 AM" value="<?php echo $data['cop_time'][0]; ?>">
			  </div>
			  <div class="form-group col-md-9">
				 <label for="jobDescription">Job Description</label>
				 <input type="text" id="jobDescription" name="jobDescription" class="form-control" value="<?php echo $data['job_description'][0]; ?>">
			  </div>
			</div>
			<hr>
			<div class="row">
			<br />
				<div class="col-md-12">
					<button class="btn btn-default" type="button" title="Add a New Blank Row" id="plusone"><i class="fa fa-plus" aria-hidden="true"></i></button>
					<button class="btn btn-default" type="button" title="Copy Last Row" id="copyLastRow"><i class="fa fa-clone" aria-hidden="true"></i></button>
<!--					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Advanced Copy Features</button>-->
					<a type="button" class="btn btn-warning" data-toggle="collapse" href="#advancedFeatures-<?php the_ID(); ?>">Advanced Copy Features</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="advancedFeatures-<?php the_ID(); ?>" class="collapse row padding-top">
						<div class="col-md-6">
						  <label for="copyfornum">What row would you like to copy? </label>
							  <input type="text" class="form-control" id="copyformnum" min='1' value="1" step='1' >						
						</div>
						<div class="col-md-6">
							<div class="input-group">
							  <label for="numform">How many times would you like to copy this row?</label>
							  <input type="number" class="form-control" id="numform" min='1' value='1' step="1">
							  <span class="input-group-btn" style="vertical-align: bottom!important;" >
								<button class="btn btn-default" type="button" id="addform">Go</button>
							  </span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog max-sixhundred" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Advanced Copy Features</h4>
				  </div>
				  <div class="modal-body">
					<div class="form-check row">
					<div class="col-sm-12">
						  <label for="copyfornum">What row would you like to copy? </label>&nbsp;<a href="#" data-toggle="popover"  data-trigger="focus" title="Tip" data-content="For example: to copy row the first row use 1."><span class="badge label-success">i</span></a>
						  <input type="text" class="form-control" id="copyformnum" min='1' value="1" step='1' >
					</div>
					</div>
					<br />
					<div class="form-check row">
					<div class="col-sm-12">
						<div class="input-group">
						  <label for="numform">How many times would you like to copy this row?</label>
						  <input type="number" class="form-control" id="numform" min='1' value='1' step="1">
						  <span class="input-group-btn" style="vertical-align: bottom!important;" >
							<button class="btn btn-default" type="button" id="addform">Go</button>
						  </span>
						</div>
					</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			 /Modal -->
			<br />
			<div class="table-fix-zu">
				<table class="table table-bordered table-striped" id="forms">
							
					<thead>
						<tr>
							<?php
								foreach($form_colms as $col){
							?>
							<th class="<?php echo $col['classname'];?>"><?php echo $col['headname'];?></th>
							<?php
								}							
							?>

						</tr>
					</thead>
					<tbody id='formbody'>
						<?php
							if ( basename(get_permalink()) == "add-a-job" ) {
						?>
							<tr>
								<?php
									foreach($form_colms as $col){
										switch ($col['inputtype'] ){
											case "text":
												?>
												<td><input class="form-control" type="<?php echo $col['inputtype']; ?>" name="<?php echo $col['fieldname'].'_0'; ?>"></td>
												<?php
												break;
											case "checkbox":

												?>
												<td><input type="hidden" value="0" name="<?php echo $col['fieldname'].'_0'; ?>">
													<input class="form-control" type="<?php echo $col['inputtype']; ?>" value="1" name="<?php echo $col['fieldname'].'_0'; ?>"></td>
												<?php
												break;
										}
									}

								?>

								<td><button class="btn btn-danger deleteRow" type="button" title="Delete this Row" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>
							</tr>
						<?php
							}else{
								
							
							$numrow=0;
						
							foreach($data as $k=>$va){
								if(preg_match("/^form_name_\d/",$k)){
									$numrow++;
								}
							}
						
						  for($i=0;$i<$numrow;$i++){
						?>
							<tr>
								<?php
									foreach($form_colms as $col){
										switch ($col['inputtype'] ){
											case "text":
												?>
												<td><input class="form-control" type="<?php echo $col['inputtype']; ?>" name="<?php echo $col['fieldname'].'_'.$i; ?>" value="<?php echo get_post_meta(get_the_ID(), $col['fieldname'].'_'.$i, true); ?>"></td>
												<?php
												//echo var_dump(get_post_meta(get_the_ID(), $col['fieldname'].'_'.$i, true));
												break;
											case "checkbox":
												$c=get_post_meta(get_the_ID(),$col['fieldname'].'_'.$i,true);
												if ($c==1) {$isChecked="checked";}
												if ($c==0) {$isChecked="";}
												?>
												<td><input type="hidden" value="0" name="<?php echo $col['fieldname'].'_'.$i; ?>">
													<input class="form-control" type="<?php echo $col['inputtype']; ?>" value="1" name="<?php echo $col['fieldname'].'_'.$i; ?>" <?php echo $isChecked; ?>></td>
												<?php
												break;
										}
									}

								?>


								<td><button class="btn btn-danger deleteRow" type="button" title="Delete this Row" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>
							</tr>						
						
						<?php
							  }
						  } 
						?>

						
						
					</tbody>
				  </table>
				  
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<?php if ( $postTitleError != '' ) { ?>
						<span class="error"><?php echo $postTitleError; ?></span>
						<div class="clearfix"></div>
					<?php } ?>
					
					<button id="regularButton"type="submit" class="btn btn-primary" name="firstSubmit">Update Job</button>
					<button id="schedulerButton" type="submit" class="btn btn-primary" name="secondSubmit" value="<?php the_ID(); ?>">Update Job</button>
				</div>
			</div>
		</form>
	