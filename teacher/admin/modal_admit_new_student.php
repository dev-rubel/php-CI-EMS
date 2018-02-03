<?php
$session = $this->db->get_where('settings', array('type' => 'admission_session'))->row()->description;
$result = oneDim($this->db->get_where('admit_std',array('id'=>$param2))->result_array());
extract($result);
//pd($result);
?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo base_url()."assets/images/admission_student/$session/".$img;?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3><?php echo $name;?></h3>
							<h3><?php echo $namebn;?></h3>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <?php echo form_open(base('homemanage','transfer_admit_student') ,'', array('student_id'=>$id));?>
                <table class="table table-bordered" style="width: 80%; margin: 0 auto;">
                
                    <tr style="padding: 0px 10px">
                        <td width="100px"><?php echo get_phrase('want_to_to_admit');?></td>
                        <td><select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                data-message-required="<?php echo get_phrase('value_required'); ?>"
                                onchange="return get_class_sections(this.value)">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select></td>
                    </tr>
                    
                    <tr class="groupHolder">
                        <td width="100px"><?php echo get_phrase('group');?></td>
                        <td><select class="form-control groupSection" name="group_id" id="group_selector_holder">
                            <option value=""><?php echo get_phrase('select_group'); ?></option>
                        </select></td>
                    </tr>

                    <tr class="sectionHolder">
                        <td width="100px"><?php echo get_phrase('section');?></td>
                        <td><select name="section_id" class="form-control" id="section_selector_holder">
                            <option value=""><?php echo get_phrase('select_section'); ?></option>

                        </select></td>
                    </tr>
                    
                    <tr>
                        <td width="100px"><?php echo get_phrase('shift');?></td>
                        <td><select name="shift_id" class="form-control" id="shift_selector_holder">
                            <option value=""><?php echo get_phrase('select_shift'); ?></option>
                            <?php $shiftList = $this->db->get('shift')->result_array();
                                foreach($shiftList as $list):
                            ?>
                            <option value="<?php echo $list['shift_id'];?>"><?php echo $list['name'];?></option>
                            <?php endforeach;?>

                        </select></td>
                    </tr>
                    
                    <tr>
                        <td width="100px"><?php echo get_phrase('roll');?></td>
                        <td><select name="roll" class="form-control" id="roll_selector_holder" style="width: 200px; display: inline-block;">
                        </select>
						<button type="button" class="btn btn-info btn-sm" onclick="get_std_roll()">Find Roll</button>	
                        </td>
                    </tr>
                    <tr>
                        <td  width="100px">Admit Fee</td>
                        <td><input type="number" class="form-control" name="fee" data-validation="required"/></td>
                    </tr>
                    <tr>
                        <td><button type="submit" class="btn btn-info btn-sm">Add</button></td>
                    </tr>
                </table>
                <?php echo form_close();?>
			</div>
		</div>		
	</section>
	
	
	
</div>


<script>
    $('.sectionHolder').hide();
    $('.groupHolder').hide();
    $('#loading').hide();
    $('#overlayDiv').hide();


function get_std_roll(){

    if(!$('#shift_selector_holder').val() || !$('#section_selector_holder').val() || !$('#class_id').val()){

            alert('Please Select All Option Properly.');
    }else{

            $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                groupid : $('#group_selector_holder').val(),
                shiftid : $('#shift_selector_holder').val(),
                sectionid : $('#section_selector_holder').val(),
                classid : $('#class_id').val()
            },
            beforeSend: function() { 
            //  alert("start");
                    $('#loading').show();
                    $('#overlayDiv').show();
            },  
            url: '<?php echo base_url(); ?>index.php?admin/get_student_roll',
            success: function (response)
            {   
                console.log(response);
                $('#roll_selector_holder').empty();
                $('#roll_selector_holder').append('<option value="">Available Rolls</option>');
                jQuery.each(response, function(index, item) {
                    var div_data="<option value="+item+">"+item+"</option>";
                    $(div_data).appendTo('#roll_selector_holder'); 
                });
                $('#loading').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

};
        
         



    


    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_group/' + class_id,
            success: function (response)
            {   
                if(response){
                    $('.groupHolder').show();
                    jQuery('#group_selector_holder').html(response);                  
                }else{
                    $('.groupHolder').hide();
                }
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response)
            {
                if(response){
                    $('.sectionHolder').show();
                    jQuery('#section_selector_holder').html(response);                
                }else{
                    $('.sectionHolder').hide();
                }
            }
        });

    }

</script>