<?php 
    $arr = ['admission_exam_date','admission_exam_time',
    'admission_link_status','admission_sms_title',
    'admission_sms_description','admission_session','admission_exam_mark'];

    $this->db->where_in('type',$arr);
    $result1 = $this->db->get('settings')->result_array();
    $session = $result1[5]['description'];
?>
<div class="row">
    <div class="col-md-12">

        <div class="col-md-6 col-md-offset-3">
            <h3 class="text-center"><a href="<?php echo base('Home', 'download_online_addmission_student_info');?>" class="btn btn-info" target="_blank" title="Click to download marksheet"><?php echo 'Download This Session Student Information'?></a></h3>
            <form id="updateAdmissionInfo" action="<?php echo base_url() .'index.php?homemanage/ajax_update_admission_info'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   
            <div id="update_admission_info_selector">
                <div class="form-group">
                <label for="exampleInputName2">Admission Exam Date</label>
                <input type="text" name="admission_exam_date" class="form-control" id="exampleInputName2" placeholder="EG.16 December" value="<?php echo $result1[0]['description'];?>">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail2">Admission Exam Time</label>
                <input type="text" name="admission_exam_time" class="form-control"  placeholder="EG.10:00PM/10:00AM" value="<?php echo $result1[1]['description'];?>">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail2">Admission Mark Distribution</label>
                <input type="text" name="admission_exam_mark" class="form-control" placeholder="Bangla 30 + English 30 + Math 40 = 100" value="<?php echo $result1[6]['description'];?>">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail2">SMS Title</label>
                <input type="text" name="admission_sms_title" class="form-control" placeholder="title" value="<?php echo $result1[3]['description'];?>" <?php echo !empty($nihalit)?'':'readonly="readonly"'?>>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail2">SMS Description</label>
                <textarea class="form-control" name="admission_sms_description" placeholder="Description" <?php echo !empty($nihalit)?'':'readonly="readonly"'?>><?php echo $result1[4]['description'];?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Admission Page: &nbsp;</label>
                <input type="checkbox" name="admission_link_status" id="admission_link_status" data-toggle="toggle" <?php echo $result1[2]['description']==1?'checked':''?>>
                </div>
                <div class="form-group">
                <label for="exampleInputName2">Admission Session: </label>
                <select name="admission_session" class="form-control" id="exampleInputName2">
                    <?php foreach(range(2016, date('Y')+1) as $k=>$each):?>
                    <option value="<?php echo $each;?>" <?php echo $session==$each?'selected':'';?>>
                        <?php echo $each;?>
                    </option>
                    <?php endforeach;?>
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-info">Update</button>
            </form>
        </div>

    </div>
</div>
                  
<script type="text/javascript">

$(document).ready(function() { 

    $('#updateAdmissionInfo').ajaxForm({ 
        beforeSend: function() {                
                $('#loading').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);            
            toastr.success(jData.msg);  
            $( "#update_admission_info_selector" ).html( jData.html );
            $('#admission_link_status').bootstrapToggle();
            $('body,html').animate({scrollTop:0},800);
            $('#loading').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                  
        }
    }); 

});

</script>