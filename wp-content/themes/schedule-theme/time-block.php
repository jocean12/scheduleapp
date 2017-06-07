<?php
$seconds = $value/1000;
$compensate = $seconds - 14400;
?>
<li id="<?php echo $value ?>" class="timeBlock panel ui-state-default">
	<button class="btn btn-sm btn-warning" title="Drag and Drop to Move"><i class="fa fa-arrows" aria-hidden="true"></i></button> 
	&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;<input style="width:300px;display:inline-block;height:30px;" class="form-control datepicker" type="text" value="<?php echo date("m/d/Y h:i a", $compensate); ?>"><button class="deleteBlock btn btn-sm btn-danger pull-right" type="button" title="Delete this Time Block" ><i class="fa fa-trash" aria-hidden="true"></i></button>
</li>