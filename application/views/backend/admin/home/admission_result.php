<?php
//pd($result);
!empty($result[0]['class'])?$Sclass = 'Class '.$result[0]['class']:$Sclass='';
!empty($result[0]['group'])?$Sgroup = ', Group: '.ucwords($result[0]['group']):$Sgroup='';

!empty($result[0]['class'])?$Oclass = $result[0]['class']:$Oclass='';
!empty($result[0]['group'])?$Ogroup = $result[0]['group']:$Ogroup='';
?>

<style>
    .dataTables_wrapper .select2-container {
        margin-left: 0px;
    }
    .page-body .select2-container .select2-choice {
        height: 20px;
        line-height: 20px;
        padding-left: 50px;
    }
    .page-body .select2-container .select2-choice .select2-arrow {
        width: 22px;
    }
    div.dt-buttons {
        top: 15px;
        font-weight: bold;
    }
    .panel {
        margin: 0px !important;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="<?php echo !empty($result)?'':'active';?>">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('add_result'); ?>
                </a>
            </li>
            <li>
                <a href="#list2" data-toggle="tab"><i class="entypo-menu"></i> 
                    Bulk Result Add
                </a>
            </li>
            <li>
                <a href="#list3" data-toggle="tab"><i class="entypo-menu"></i> 
                    Search
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box <?php echo !empty($result)?'':'active';?>" id="list">
                <div class="col-md-4 col-md-offset-1">
                    <form id="addResult" action="<?php echo base_url() .'index.php?homemanage/ajax_add_admission_result'; ?>" class="form-horizontal form-groups-bordered" method="post">                            
                        <div class="form-group">
                            <label>Admission Roll No.</label>
                            <input type="number" class="form-control" name="uniq_id" aria-describedby="emailHelp" placeholder="eg.29" autofocus>

                        </div>
                        <div class="form-group">
                            <label>Obtain Mark</label>
                            <input type="number" class="form-control" name="mark" step="any" required> 
                        </div>
                        <button type="submit" id="hideButton" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="col-md-offset-1 col-md-5" id="searchAdmissionStudent"></div>

            </div>
         

            <!-- TABLE LISTING ENDS -->

            <div class="tab-pane box" id="list2">
                <form id="bulkAddResult" action="<?php echo base('homemanage','bulk_add_admission_result');?>" method="post">
                    <div class="col-md-12">
                        <?php foreach(range(1,10) as $k=>$each):?>
                            <div class="col-md-3">
                                <label>Roll</label>
                                <input type="number" class="form-control" name="roll[<?php echo $each;?>]" id="addRoll<?php echo $each;?>" onkeyup="checkValidAddRoll('<?php echo $each;?>',this.value)"> 
                            </div>
                            <div class="col-md-3">
                                <label>Mark</label>
                                <input type="number" class="form-control mark-input" name="mark[<?php echo $each;?>]" id="addmark<?php echo $each;?>" disabled> 
                            </div>
                        <?php endforeach;?>
                    </div>
                    
                    <div class="col-md-12 text-center">
                        <br><br>
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>
                </form>
            </div>
			 
			<div class="tab-pane box" id="list3">
                
                <div class="col-md-12">
                    <form id="admissionResultHolder" action="<?php echo base_url() .'index.php?homemanage/ajax_getClassResult'; ?>" class="form-horizontal form-groups-bordered" method="post">   
                        <div class="col-md-3 col-md-offset-1">
                                <div class="form-group row">
                                    <label class="col-form-label">Search mark-sheet by class</label>
                                    <select class="form-control" id="classID" name="class" >
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option value="91">9 Voc</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-form-label">Gender</label>
                                    <select class="form-control" name="sex" >
                                        <option value="1">Boy</option>
                                        <option value="2">Girl</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-2">
                                <div class="form-group row groupHolder">
                                    <label class="col-md-2 col-form-label">Group</label>
                                    <select class="form-control" name="group" >
                                        <option value="">Select</option>
                                        <option class="group1" value="business-studies">Business Studies</option>
                                        <option class="group1" value="science">Science</option>
                                        <option class="group1" value="humanities">Humanities</option>
                                        
                                        <option class="group2" value="electrical">Electrical</option>
                                        <option class="group2" value="mechanical">Mechanical</option>
                                        <option class="group2" value="dressMaking">Dress Making</option>
                                    </select>
                                </div>
                        </div>
                            <div class="form-group">
                                <button class="btn btn-primary" style="margin-top: 6px;" type="submit">Search</button>
                            </div>
                    </form>
                </div>

                <div id="admission_result_section_holder" class="col-md-12"></div>
            </div>


        </div>

    </div>

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="assets/js/jquery.dataTables.min.js"></script>-->


<script>
 function checkValidAddRoll(id,value){
        if(value != ''){
            $.ajax({
                url: '<?php echo base_url();?>index.php?homemanage/getValidAddmisionStudent/' + value ,
                success: function(data)
                {
                    var jData = JSON.parse(data);   
                    if(jData.type){
                        $('#addmark'+id).removeAttr('disabled');
                        if(jData.msg){
                            $('#addmark'+id).val(jData.msg);                            
                        } else {
                            $('#addmark'+id).attr("placeholder", "Not Insert Yet");
                        }                        
                        
                    } else {                        
                        $('#addmark'+id).attr('disabled','disabled');
                        $('#addmark'+id).val('');
                        $('#addmark'+id).attr("placeholder", "Not Found");
                    }
                }
            });  
        }      
    }
$(document).ready(function() { 
    /* Change Password */
    // toastr.options.positionClass = 'toast-bottom-right';
    
   $('#addResult').ajaxForm({ 
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);            
            toastr.success(jData.msg);  
            $( "#searchAdmissionStudent" ).html( jData.html );
            $('body,html').animate({scrollTop:0},800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                  
        }
    }); 

   $('#bulkAddResult').ajaxForm({ 
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);            
            toastr.success(jData.msg);  
            $('#bulkAddResult').resetForm(); 
            $('.mark-input').attr('disabled','disabled');
            $('.mark-input').val('');
            $('.mark-input').removeAttr('placeholder');
            
            $('body,html').animate({scrollTop:0},800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                  
        }
    }); 

    $('#admissionResultHolder').ajaxForm({ 
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);  

            if(!jData.type) {    
                toastr.error(jData.msg);
                $( "#admission_result_section_holder" ).html( '' );
                $('body,html').animate({scrollTop:0},800);
            } else {
                toastr.success(jData.msg);  
                $( "#admission_result_section_holder" ).html( jData.html );                               
                $('body,html').animate({scrollTop:400},800);
            }         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');   
                              
        }
    }); 

});
    
$("#classID").change(function() {
    var selectValue = $("#classID option:selected").val();  
    //alert(selectValue);
    if(selectValue === "9"){
        $('.group1,.groupHolder').show();
        $('.group2').hide();
    }else if(selectValue === "91"){
        $('.group2,.groupHolder').show();
        $('.group1').hide();
    }else{
        $('.groupHolder').hide();}
});
$(document).ready(function () {
    $('.groupHolder').hide();
    
    
    $( "input[name=uniq_id]" ).keyup(function() {
        var value = $( this ).val();
        //alert(value);
        $.ajax({
        url: '<?php echo base_url();?>index.php?homemanage/getAdmitStdName/' + value ,
        success: function(response)
        {
            $( "#searchAdmissionStudent" ).html( response );  
        }
    });
    
    });
    $('#example').DataTable();
});
</script>