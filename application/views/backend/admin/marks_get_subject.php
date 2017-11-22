<?php if(!empty($groups)): ?>
<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('groups');?></label>
		<select name="group_id" id="group_id" class="form-control selectboxit">
			<option value="">Select Group</option>
			<?php foreach($groups as $row): ?>
			<option value="<?php echo $row['group_id'];?>"><?php echo ucwords($row['name']);?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<?php endif; ?>

<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<?php 
				$sections = $this->db->get_where('section' , array(
					'class_id' => $class_id 
				))->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>


<?php if(!empty($groups)): ?>
<div class="col-md-2" id="group_holder">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
		<select name="subject_id" class="form-control" id="subject_id_two">
			
		</select>
	</div>
</div>
<?php else: ?>

<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
		<select name="subject_id" id="subject_id" class="form-control">
			<?php 
				$subjects = $this->db->get_where('subject' , array(
					'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
				))->result_array();
				foreach($subjects as $row):
			?>
			<option value="<?php echo $row['subject_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<?php endif; ?>

<div class="col-md-2" style="margin-top: 20px;">
	<center>
		<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_marks');?></button>
	</center>
</div>

<?php if(!empty($groups)): ?>
	
	<script type="text/javascript">
	$('#subject_id_two').append('<option>Select Group</option>');

	$("#group_id").change(function(){
		var groupId = this.options[this.selectedIndex].value;
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/marks_get_group_subject/' + groupId ,
            success: function(response)
            {
                
                if(response){
                	var json = JSON.parse(response);
                	$('#subject_id_two').empty();
					jQuery.each( json, function( key, value ) {
					  var data =  "<option value="+value.subject_id+">"+value.name+"</option>";
					  $(data).appendTo('#subject_id_two');					  
					});
                }else{
                	$('#subject_id_two').empty();
 					$('#subject_id_two').append('<option>No Subject Found</option>');
                }
                
            }
        });

	});
			
</script>

<?php endif ?>

<script type="text/javascript">
	$(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
		{
			$("select.selectboxit").each(function(i, el)
			{
				var $this = $(el),
					opts = {
						showFirstOption: attrDefault($this, 'first-option', true),
						'native': attrDefault($this, 'native', false),
						defaultText: attrDefault($this, 'text', ''),
					};
					
				$this.addClass('visible');
				$this.selectBoxIt(opts);
			});
		}
    });
	
</script>