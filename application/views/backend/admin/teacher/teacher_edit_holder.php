<div id="innerEditTeacherHoder">

<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id) )->result_array();
foreach ( $edit_data as $row):

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
			
	
				<form id="updateTeacher" action="<?php echo base_url() .'index.php?admin/ajax_update_teacher/'.$row['teacher_id']; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype="multipart/form-data"> 
	
	
				<div class="col-md-6">
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row['birthday'];?>" data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-8">
							<select name="sex" class="form-control">
							<option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
							<option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
		
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-8">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update_information');?></button>
						</div>
					</div>
				</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
</div>

<script>


$(document).ready(function() {

$('#updateTeacher').ajaxForm({ 
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
            $( "#teacherList" ).html( jData.html );
            $("#table_export").dataTable();
            $( "#innerEditTeacherHoder" ).html( '' );                  
        }   
        $('body,html').animate({scrollTop:0},800);         
        $('#loading2').fadeOut('slow');
        $('#overlayDiv').fadeOut('slow');                   
    }
});

  


});

</script>