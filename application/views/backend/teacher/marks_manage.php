<hr />
<form id="markSelector" action="<?php echo base_url() .'index.php?admin/ajax_marks_selector'; ?>" method="post">   
<div class="row">

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam');?></label>
			<select name="exam_id" class="form-control">
				<?php
					$exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
					foreach($exams as $row):
				?>
				<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control" onchange="get_class_subject(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	

	<div id="subject_holder">
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
				<select name="" id="" class="form-control" disabled="disabled">
					<option value=""><?php echo get_phrase('select_class_first');?></option>		
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
				<select name="" id="" class="form-control" disabled="disabled">
					<option value=""><?php echo get_phrase('select_class_first');?></option>		
				</select>
			</div>
		</div>
		<div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled"><?php echo get_phrase('manage_marks');?></button>
			</center>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('rolls');?> (Maximam 10)</label>
			<input type="text" class="form-control" name="rolls" data-role="tagsinput" id="rollTags">
		</div>
	</div>
</div>
<?php echo form_close();?>

<div id="studentMarkHolder"></div>



<script>

$('#markSelector').ajaxForm({ 
	beforeSend: function() {                
			$('#loading2').show();
			$('#overlayDiv').show();
	},  
	success: function (data){
		var jData = JSON.parse(data);  
		if(!jData.type) {    
			toastr.error(jData.msg);
		} else {
			toastr.success(jData.msg);  
			$( "#studentMarkHolder" ).html( jData.html );               
		}   
		$('body,html').animate({scrollTop:0},800);         
		$('#loading2').fadeOut('slow');
		$('#overlayDiv').fadeOut('slow');                   
	}
}); 


</script>

<script type="text/javascript">

	$("#rollTags").tagsinput({
		maxChars: 3,
		maxTags: 10,
		trimValue: true
	});
	function get_class_subject(class_id) {
		
		$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/marks_get_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });

	}
</script>