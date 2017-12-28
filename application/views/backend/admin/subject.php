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
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('mark');?></div></th>
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
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
                            <td><?php echo count($joinOrNot)>1?$row['name'].' | <b>Join</b>':$row['name'].'<b> | '.ucfirst($row['subject_category']).'</b>'; echo '<b> | '.ucwords(notEmpty($groupName)).'</b>';?></td>
							<td><?php echo count($joinOrNot)>1?$row['subject_mark'].' | <b>'.($joinOrNot[0]['subject_mark']+$joinOrNot[1]['subject_mark']).'</b>':$row['subject_mark']; ?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_subject/<?php echo $row['subject_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/subject/delete/<?php echo $row['subject_id'];?>/<?php echo $class_id;?>');">
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
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'), array('class_id'=>$class_id));?>
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
                                            $countJoin = $this->db->get_where('subject',array('class_id'=>$class_id,'subject_category'=>'main'))->result_array();
                                            if(count($countJoin) > 0):
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
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="groupSubject">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('group_subject_name');?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="group_subject_name" id="group_subject_holder">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject_mark');?></label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="subject_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_subject');?></button>
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
    $('#joinSubject').hide();
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
                        $.each(jsonvalue, function(key, value){
                            var div_data="<option value="+value.subject_code+">"+value.name+"</option>";
                            $(div_data).appendTo('#join_subject_holder'); 
                        })
                    }else{
                        $('#joinSubject').show();                        
                        $('#join_subject_holder').append('<option value="">No Main Subject Found</option>');
                    }
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

                        $.each(jsonvalue, function(key, value){
                            var div_data="<option value="+value.group_id+">"+titleCase(value.name)+"</option>"; 
                            $(div_data).appendTo('#group_subject_holder'); 
                        })
                    }else{
                        $('#groupSubject').show();
                        $('#group_subject_holder').append('<option value="">No Group Found</option>');
                    }
                }
            });

        }else{
            $('#groupSubject').hide();
            $('#joinSubject').hide();
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