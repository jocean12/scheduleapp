<?php /*?><?php $data = get_post_meta(get_the_ID()); 
	if (($data['job_status'][0]) != "Shipped") {
?><?php */?>
	  <?php if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>

	  <li id="<?php the_ID(); ?>" class="panel ui-state-default">
		<button class="btn btn-sm btn-warning" title="Drag and Drop to Move"><i class="fa fa-arrows" aria-hidden="true"></i></button> 
		<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#editJob-<?php the_ID(); ?>" title="Edit Job"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
		<!-- Modal -->
			<div class="modal fade large-modal" id="editJob-<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="full-width modal-dialog" role="document">
				<div class="modal-content container">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
					<h4 class="modal-title" id="myModalLabel">Quick Edit</h4>
				  </div>
				  	<div class="modal-body">
						<?php include('input-form.php'); ?>
					</div>
				  <div class="modal-footer">  
				  </div>
				  </div>
				</div>
			  </div>
			<!-- /Modal -->
		<a data-toggle="collapse" class="btn pull-right  btn-sm btn-info" title="View More" href="#link-<?php the_ID(); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
		&nbsp;&nbsp;<strong><?php the_title(); ?></strong>
		&nbsp;&nbsp;&nbsp;<?php echo get_post_meta(get_the_ID(), 'customer', true); ?>
		&nbsp;&nbsp;&nbsp;COP: <?php 
		   $data = get_post_meta(get_the_ID()); 
		  if ($data['cop'][0]==1) { 
			  echo "Yes, " . $data['cop_time'][0];
		  } else { 
			  echo "No"; 
		  };?>
		&nbsp;&nbsp;&nbsp;<?php echo $data['job_description'][0]; ?>

		<div id="link-<?php the_ID(); ?>" class="collapse padding-top">
		<table class="table table-bordered table-striped" id="schedule-table">

			<thead>
				<tr>
					<?php
						foreach($form_colms as $col){
					?>
					<th> <?php echo $col['headname'];?></th>
					<?php
						}							
					?>

				</tr>
			</thead>
			<tbody id='formbody'>
				<?php


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
									<td><?php echo get_post_meta(get_the_ID(), $col['fieldname'].'_'.$i, true); ?></td>
									<?php
									//echo var_dump(get_post_meta(get_the_ID(), $col['fieldname'].'_'.$i, true));
									break;
								case "checkbox":
									$c=get_post_meta(get_the_ID(),$col['fieldname'].'_'.$i,true);
									if ($c==1) {$isChecked="Yes";}
									if ($c==0) {$isChecked="No";}
									?>
									<td><?php echo $isChecked; ?></td>
									<?php
									break;
							}
						}
					?>
				</tr>						

				<?php
					  }
				?>
			</tbody>
		</table>
	</div>
</li>
<?php endwhile; ?>


<?php endif;
// }
?>