<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('subject_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_subject');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
        <br>            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            
            <div id="editSubjectHolder"></div>
				<div id="subjectList">
                
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('mark_distribution');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
                        $count = 1;foreach($subjects as $row):
                        $joinOrNot = $this->db->get_where('subject',array('subject_code'=>$row['subject_code']))->result_array();
                        $groupName = $this->db->get_where('group',array('group_id'=>$row['group_id']))->row()->name;
                        ?>
                        <tr id="subject<?php echo $row['subject_id'];?>">
							<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
                            <td><?php echo count($joinOrNot)>1?$row['name'].' | <b>Join</b>':$row['name'].'<b> | '.ucfirst($row['subject_category']).'</b>'; echo '<b> | '.ucwords(notEmpty($groupName)).'</b>';?></td>
                            <td><?php 
                                $subject_marks = explode('|', $row['subject_marks']);
                                if(count($joinOrNot)>1) {                                    
                                    echo 'MT: '.$subject_marks[0].'| CQ: '.$subject_marks[1].'| MCQ: '.$subject_marks[2].'| PR: '.$subject_marks[3].'| <b>Total: '.($joinOrNot[0]['total_mark']+$joinOrNot[1]['total_mark']).'</b>';
                                } else {
                                    echo 'MT: '.$subject_marks[0].'| CQ: '.$subject_marks[1].'| MCQ: '.$subject_marks[2].'| PR: '.$subject_marks[3].'| <b>Total: '.($joinOrNot[0]['total_mark']+$joinOrNot[1]['total_mark']).'</b>';
                                } ?>
                            </td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="editSubject('<?php echo $row['subject_id'];?>','<?php echo $row['class_id']; ?>')">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confDelete('admin','ajax_delete_subject','<?php echo $row['subject_id'];?>','subject<?php echo $row['subject_id'];?>')">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

                </div>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	
                    <form id="createSubject" action="<?php echo base_url() .'index.php?admin/ajax_create_subject'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   

                        <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject_category');?></label>
                                <div class="col-sm-5">
                                    <select name="subject_category" class="form-control" style="width:100%;" onchange="return get_join_subject(this.value)">
                                        <option value=""><?php echo get_phrase('select_category');?></option>
                                        <option value="main">Main Subject</option>
                                        <?php $classNumaric = $this->db->get_where('class',array('class_id'=>$class_id))->row()->name_numeric;
                                        if($classNumaric > 8 && $classNumaric < 11):
                                        ?>
                                        <option value="group">Group Subject</option>                                       
                                        <?php endif;?>
                                        <?php if($classNumaric > 7 && $classNumaric < 11):?>
                                        <option value="optional">Optional Subject</option>   
                                        <?php endif;?>    
                                        <?php 
                                            $countMain = $this->db->get_where('subject',array('class_id'=>$class_id,'subject_category'=>'main'))->result_array();
                                            $countJoin = $this->db->get_where('subject',array('class_id'=>$class_id,'subject_category'=>'join'))->result_array();
                                            if(count($countMain) > 0 && count($countJoin) <= 2):
                                        ?>                                
                                            <option value="join">Join Subject</option>
                                                
                                        <?php endif; ?>                                                                  
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="joinSubject">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('join_subject_list');?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="join_subject_code" id="join_subject_holder">
                                        <option value="">Select One</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="groupSubject">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('group_subject_name');?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="group_subject_name" id="group_subject_holder">
                                        <option value="">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('mark_distribution');?></label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control markSum" name="mt_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" placeholder="MT Mark"/>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control markSum" name="cq_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" placeholder="CQ Mark"/>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control markSum" name="mcq_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" placeholder="MCQ Mark"/>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control markSum" name="pr_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" placeholder="PR Mark"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('total_mark');?></label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control markTotal" name="total_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly/>
                                </div>
                                <h4 style="color: red;" class="invalidMark">Invalid Mark</h4>
                            </div>
                            
                            <input type="hidden" name="subject_code" value="<?php echo substr(md5(rand(0, 1000000)), 0, 5);?>">
                            <input type="hidden" name="year" value="<?php echo $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;?>">

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                                <div class="col-sm-5">
                                    <select name="teacher_id" class="form-control" style="width:100%;">
                                        <option value=""><?php echo get_phrase('select_teacher');?></option>
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info markSaveButton"><?php echo get_phrase('add_subject');?></button>
                            </div>
                        </div>
                    </form>                
                </div>                
			</div>
			<!-- CREATION FORM ENDS-->
            
		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
    $('#join_subject_holder').attr('disabled','disabled');
    $('#joinSubject').hide();
    $('#group_subject_holder').attr('disabled','disabled');
    $('#groupSubject').hide();

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

    function get_join_subject(name)
    {
        this.class_id = <?php echo $class_id;?>;
        if(name=='join'){
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admin/get_join_subject_info/' + this.class_id,
                success: function (response)
                {   
                    if(response){
                        $('#joinSubject').show();
                        $('#join_subject_holder').empty();
                        var jsonvalue =  JSON.parse(response);
                        $('#join_subject_holder').append('<option value="">Select One</option>');
                        $.each(jsonvalue, function(key, value){
                            var div_data="<option value="+value.subject_code+">"+value.name+"</option>";
                            $(div_data).appendTo('#join_subject_holder'); 
                        });
                    }else{
                        $('#joinSubject').show();                        
                        $('#join_subject_holder').append('<option value="">No Main Subject Found</option>');
                    }
                    $('#group_subject_holder').attr('disabled','disabled');
                }
            });

        }else if(name=='group' || name=='optional'){
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admin/get_group_subject_info/' + this.class_id,
                success: function (response)
                {   

                    if(response){
                        $('#groupSubject').show();
                        $('#group_subject_holder').empty();
                        var jsonvalue =  JSON.parse(response);
                        $('#group_subject_holder').append('<option value="">Select One</option>');
                        $.each(jsonvalue, function(key, value){
                            var div_data="<option value="+value.group_id+">"+titleCase(value.name)+"</option>"; 
                            $(div_data).appendTo('#group_subject_holder'); 
                        })
                    }else{
                        $('#groupSubject').show();
                        $('#group_subject_holder').append('<option value="">No Group Found</option>');
                    }
                    $('#join_subject_holder').attr('disabled','disabled');
                }
            });

        }else{
            $('#groupSubject').hide();
            $('#group_subject_holder').attr('disabled','disabled');
            $('#joinSubject').hide();
            $('#join_subject_holder').attr('disabled','disabled');
        }
        
    }


    function titleCase(str) {
       var splitStr = str.toLowerCase().split('-');
       for (var i = 0; i < splitStr.length; i++) {
           // You do not need to check if i is larger than splitStr length, as your for does that for you
           // Assign it back to the array
           splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
       }
       // Directly return the joined string
       return splitStr.join('-'); 
    }
		
</script>

<script>

// CALCULATE TOTAL MARK AND SET INTO SUBJECT MARK INPUT FIELD
$(".invalidMark").hide();
$(document).on("change", ".markSum", function() {
    var sum = 0;
    $(".markSum").each(function(){
        sum += +$(this).val();
    });
    if(sum > 100) {
        $(".invalidMark").show();
        $(".markSaveButton").attr('disabled','disabled');
    } else {
        $(".invalidMark").hide();
        $(".markSaveButton").removeAttr('disabled','disabled');
    }
    $(".markTotal").val(sum);
});

$(document).ready(function() {
  
    $('#createSubject').ajaxForm({ 
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
                $("#subjectList").html( jData.html );
                $("#table_export").dataTable();
                $('#createSubject').resetForm();               
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    });
});

function editSubject(subjectID, classID)
{
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url();?>index.php?admin/ajax_edit_subject/'+subjectID+'/'+classID,
        beforeSend: function(){
            $('#loading2').show();
            $('#overlayDiv').show();
        },
        success: function(data){
            var jData = JSON.parse(data); 
            
            toastr.success(jData.msg);  
            $( "#editSubjectHolder" ).html( jData.html );
            $('body,html').animate({scrollTop:350},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });
}

</script>