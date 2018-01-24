<div id="innerEditSubjectHoder">
<?php 
$edit_data = $this->db->get_where('subject' , array('subject_id' => $subject_id) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_subject');?>
            	</div>
            </div>
			<div class="panel-body">
                
                <form id="updateSubject" action="<?php echo base_url() .'index.php?admin/ajax_update_subject/'.$row['subject_id']; ?>" class="form-horizontal form-groups-bordered validate" method="post">  

                <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>

                 <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('subject_category');?></label>
                        <div class="col-sm-5">
                            <select name="subject_category" class="form-control" style="width:100%;" onchange="return get_join_subject(this.value)">
                                <option value=""><?php echo get_phrase('select_category');?></option>
                                <option value="main" <?php echo $row['subject_category']=='main'?'selected':''?>>Main Subject</option>
                                <?php $classNumaric = $this->db->get_where('class',array('class_id'=>$row['class_id']))->row()->name_numeric;
                                if($classNumaric > 8 && $classNumaric < 11):
                                ?>
                                <option value="group" <?php echo $row['subject_category']=='group'?'selected':''?>>Group Subject</option>                                       
                                <?php endif;?>
                                <?php if($classNumaric > 7 && $classNumaric < 11):?>
                                <option value="optional" <?php echo $row['subject_category']=='optional'?'selected':''?>>Optional Subject</option>   
                                <?php endif;?>    
                                <?php 
                                    $countJoin = $this->db->get_where('subject',array('class_id'=>$row['class_id'],'subject_category'=>'main'))->result_array();
                                    if(count($countJoin) > 0):
                                ?>                                
                                    <option value="join" <?php echo $row['subject_category']=='join'?'selected':''?>>Join Subject</option>
                                        
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
                    <div class="col-sm-5 controls">
                        <select name="teacher_id" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php 
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['teacher_id'];?>"
                                    <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_subject');?></button>
                    </div>
                 </div>
        		</form>
            </div>
        </div>
    </div>

<?php
endforeach;
?>
</div>

<script type="text/javascript">
    $('#joinSubject').hide();
    $('#groupSubject').hide();

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



<script>
$(document).ready(function() {

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

$('#updateSubject').ajaxForm({ 
    beforeSend: function() {                
            $('#loading').show();
            $('#overlayDiv').show();
    },  
    success: function (data){
        var jData = JSON.parse(data);  

        if(!jData.type) {    
            toastr.error(jData.msg);
        } else {
            toastr.success(jData.msg);  
            $( "#subjectList" ).html( jData.html );
            $("#table_export").dataTable();
            $( "#innerEditSubjectHoder" ).html( '' );                  
        }   
        $('body,html').animate({scrollTop:0},800);         
        $('#loading').fadeOut('slow');
        $('#overlayDiv').fadeOut('slow');                   
    }
});

  


});

</script>