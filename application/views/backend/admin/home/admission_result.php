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
            <?php if(!empty($result)):?>
            <li class="<?php echo !empty($result)?'active':'';?>">
                <a href="#list2" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo $Sclass.$Sgroup.' Mark-Sheet'?>
                </a>
            </li>
            <?php endif;?>
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
                    <form action="<?php echo base('homemanage', 'add_admission_result') ?>" method="post">
                        <div class="form-group">
                            <label>Admission Roll No.</label>
                            <input type="number" class="form-control" name="std_id" aria-describedby="emailHelp" placeholder="eg.29" autofocus>

                        </div>
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" class="form-control" id="stdName" placeholder="eg.student name" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label>Obtain Mark</label>
                            <input type="number" class="form-control" name="mark" step="any" required> 
                        </div>
                        <button type="submit" id="hideButton" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box <?php echo !empty($result)?'active':'';?>" id="list2">

                <h3 class="text-center"><a href="<?php echo base('Home', 'meritlistPage/'.$Oclass.'/'.$Ogroup);?>" class="btn btn-info" target="_blank" title="Click to download marksheet"><?php echo 'Download '.$Sclass.$Sgroup.' Mark-Sheet'?></a></h3>
                <table id="example" class="table table-bordered datatable" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Merit</th>
                            <th>Roll</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Obtain Mark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $key=>$list):?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $list['std_id'];?></td>
                            <td><?php echo $list['namebn'];?></td>
                            <td><?php echo $list['fnamebn'];?></td>
                            <td><?php echo $list['mark'];?></td>     
                            <td width="100px">
                            <?php if($list['student_id']==null):?>
                                <a href="#" class="btn btn-danger btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_admit_new_student/<?php echo $list['std_id'];?>');">Admit Student</a>
                            <?php else: 
                                $invoice_id = $this->db->get_where('invoice', array('student_id' => $list['student_id']))->row()->invoice_id;
                            ?>
                                <a href="#" class="btn btn-success btn-sm" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $invoice_id;?>');">Download Invoice</a>
                            <?php endif;?>
                            </td>                       
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <br>

            <!-- TABLE LISTING ENDS -->
			 
			<div class="tab-pane box" id="list3">
                <div class="col-md-4 col-md-offset-1">
                    <form action="<?php echo base('homemanage', 'getClassResult')?>" method="post">
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
                        
                                 <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                </form>
                </div>
            </div>

        </div>


    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="assets/js/jquery.dataTables.min.js"></script>-->


<script>
    
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
        
        
        $( "input[name=std_id]" ).keyup(function() {
            var value = $( this ).val();
            //alert(value);
            $.ajax({
            url: '<?php echo base_url();?>index.php?homemanage/getAdmitStdName/' + value ,
            success: function(response)
            {
                var data = $.parseJSON(response);
                if(!data.name){
                    jQuery('#stdName').val('কোন ছাত্র খুজে পাওয়া যায় নি।');
                    jQuery('input[name=mark]').val('0');
                    $('#hideButton').hide();
                }
                else{
                    jQuery('#stdName').val(data.name);
                    jQuery('input[name=mark]').val(data.mark);
                    $('#hideButton').show();
                }
                //console.log('Done: ', response);
            }
        });
        
        });
        $('#example').DataTable({
            
        });
    });
</script>