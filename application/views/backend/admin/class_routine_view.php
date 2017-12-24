<hr />

<?php echo form_open(base_url() . 'index.php?admin/attendance_selector/');?>
<div class="row">
<div class="col-md-offset-1 col-md-10">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select id="class_id" name="class_id" class="form-control selectboxit" onchange="select_section(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
                                            
				?>
                                
				<option value="<?php echo $row['class_id'];?>"
					><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="group_holder">
    </div>
	
    <div id="section_holder">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select id="section_id" class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_section_first') ?></option>
				
			</select>
		</div>
	</div>
    </div>
	
    <div id="shift_holder">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('shift');?></label>
			<select id="shift_id" class="form-control selectboxit" name="shift_id">
                            <option value=""><?php echo get_phrase('select_shift_first') ?></option>
                            <?php $shifts = $this->db->get('shift')->result_array();
                            	foreach($shifts as $shift):
                            ?>
							<option value="<?php echo $shift['shift_id'];?>"><?php echo $shift['name'] ;?></option>						
                        	<?php endforeach;?>
				
			</select>
		</div>
	</div>
    </div>
    <div class="col-md-2">
    <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px;"></label>
    <button href="#" class="btn btn-info" type="button" onclick="get_students_class_routine()">
            <i class="entypo-plus-circled"></i>
            <?php echo get_phrase('search_routine');?></button>
    </div>
    </div>

    <div class="col-md-2">
    <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px;"></label>
        <a href="<?php echo base_url();?>index.php?admin/class_routine_add"
        class="btn btn-primary">
            <i class="entypo-plus-circled"></i>
            <?php echo get_phrase('add_class_routine');?>
        </a> 
    </div>
    </div>

    </div>

</div>
<?php echo form_close();?>

<div id="routine_holder"></div>

<script type="text/javascript">

    function get_students_class_routine()
    {
        var classID = $('#class_id').val();
        var sectionID = $('#section_id').val();
        var shiftID = $('#shift_id').val();
        var groupID = $('#group_id').val();
        if(groupID){
            groupID = $('#group_id').val();
        } else {
            groupID = '';
        }
        if (classID == "" || sectionID == "" || shiftID == "") {
            toastr.error("<?php echo get_phrase('select_all_field_properly');?>")
            return false;
        }
        $.get( "<?php echo base_url();?>index.php?admin/ajaxClassRoutine/"+classID+"/"+sectionID+"/"+shiftID+"/"+groupID, function( data ){
            $( "#routine_holder" ).html( data );  
        });
    }
   
    $('#group_holder').hide();

    function select_section(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_group/' + class_id,
            success:function (response)
            {
            	if(response){
            		$('#group_holder').show();
            		jQuery('#group_holder').html(response);	
            	}else{
            		$('#group_holder').hide();
            	}                
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>