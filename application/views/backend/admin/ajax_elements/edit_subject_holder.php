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
                    <label class="col-sm-3 control-label"><?php echo get_phrase('subject_mark');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="subject_mark" value="<?php echo $row['subject_mark'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-5 controls">
                            <?php 
                            $classes = $this->db->get_where('class',array('class_id'=>$row['class_id']))->row()->name;
                            ?>
                        <input type="text" class="form-control" name="class_id" value="<?php echo $classes;?>" disabled/>
                    </div>
                </div>
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

<script>


$(document).ready(function() {

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