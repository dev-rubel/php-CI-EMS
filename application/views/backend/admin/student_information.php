<style>
    input.std_fees {
        width: 60px;
        border: 1px solid lightslategray;
    }
    b{
        color: black;
    }
</style>
<hr />
<br>
<!-- <a href="<?php echo base_url();?>index.php?admin/student_add"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_student');?>
    </a>  -->

<?php 
$this->db->where('class_id',$class_id);                            
$this->db->where('year',$running_year);
$stdExist =  $this->db->get('enroll')->result_array();
if(!empty($stdExist)):
?>    
<a href="<?php echo base_url().'index.php?admin/export_student_info_excel/'.$class_id.'/'.$running_year;?>"
    class="btn btn-info pull-right">
        <?php echo get_phrase('export_to_excel');?>
</a> 
<?php endif;?>
<br>

<div class="row">
    <div class="col-md-12">
        
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
                </a>
            </li>
        <?php 
           
           $this->db->where('class_id',$class_id);
           $query = $this->db->get('section')->result_array();           
            
            if (!empty($query)):
                foreach ($query as $row):
        ?>
            <li>
                <a href="#<?php echo $row['section_id'];?>" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs">
                    <?php echo '<b>Section: </b>'; ?> 

                    <?php echo ucwords($row['name']);?> ( <?php echo $row['nick_name'];?> )</span>
                </a>
            </li>
        <?php endforeach;?>
        <?php endif;?>
        
        <?php 
            $this->db->where('class_id',$class_id);
            $query = $this->db->get('section')->result_array();        
            if (!empty($query)):
                foreach ($query as $row):
        ?>
            <li>
                <a href="#<?php echo $row['section_id'];?>_fees" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs">
                    <?php echo '<b>Section: </b>'; ?> 

                    <?php echo ucwords($row['name']);?> ( Student Fees )</span>
                </a>
            </li>
        <?php endforeach;?>
        <?php endif;?>

        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="home">                
                <table class="table table-bordered datatable" id="table_export2">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('id');?></div></th>
                            <th width="80"><div><?php echo get_phrase('roll');?></div></th>
                            <th width="80"><div><?php echo get_phrase('shift');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('father_name');?></div></th>
                            <th><div><?php echo get_phrase('mobile');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $this->db->order_by('roll', 'ASC');
                                $this->db->where('class_id',$class_id);
                                if(!empty($group_id)) {
                                    $this->db->where('group_id',$group_id);    
                                }
                                $this->db->where('year',$running_year);
                                $students   =   $this->db->get('enroll')->result_array();
                                foreach($students as $row):?>
                        <tr id="student<?php echo $row['student_id'];?>">
                            <td>
                                <?php echo $this->db->get_where('student',['student_id'=>$row['student_id']])->row()->student_code;;?>
                            </td>
                            <td>
                                <?php if(!empty($row['roll'])):?>
                                    <?php echo $row['roll'];?>
                                <?php else: ?>
                                    <a href="<?php echo base('admin','set_new_promotion_std_info/').$class_id.'/'.$row['student_id'];?>">Set Roll</a>
                                <?php endif;?>
                            </td>
                            <td>
                            <?php 
                            $this->db->where('shift_id',$row['shift_id']);
                            echo $this->db->get('shift')->row()->name; 
                            ?>
                            </td>
                            <td>
                            <?php $img_url = $this->crud_model->get_image_url2('student',$row['student_id']);
                                if($img_url): 
                             ?>
                            <img src="<?php echo $img_url;?>" class="img-circle" width="30" /></td>
                                <?php else: 
                                    echo $row['student_id'].'.jpg';    
                                endif;
                                ?>
                            <td>
                                <?php 
                                    $this->db->where('student_id',$row['student_id']);
                                    echo $this->db->get('student')->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $this->db->where('student_id',$row['student_id']);
                                    echo $this->db->get('student')->row()->fname;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $this->db->where('student_id',$row['student_id']);
                                    echo $this->db->get('student')->row()->mobile;
                                ?>
                            </td>
                            <td>
                            <?php if(!empty($row['roll'])):?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- STUDENT MARKSHEET LINK  -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php?admin/student_marksheet/<?php echo $row['student_id'];?>">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                                </a>
                                        </li>

                                        
                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                                </a>
                                        </li>

                                        
                                        <!-- STUDENT PROFILE PRINT LINK -->
                                        <li>
                                            <a href="<?php echo base_url(); ?>index.php?Home/profile_view/<?php echo $row['student_id'];?>" target="_blank">
                                                <i class="entypo-print"></i>
                                                    <?php echo get_phrase('print_profile');?>
                                                </a>
                                        </li>
                                        
                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>

                                        <?php if($_SESSION['name']=='NihalIT'):?>
                                        <!-- STUDENT DELETION LINK -->
                                        <li>
                                            <a href="#" onclick="confDelete('admin','ajax_delete_student','<?php echo $row['student_id'];?>','student<?php echo $row['student_id'];?>')">
                                                <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete');?>
                                            </a>
                                        </li>  
                                        <?php endif; ?> 
                                    </ul>
                                </div>
                                <?php else: ?>
                                        <p>Please Set Roll First</p>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>                    
            </div>
        <?php 
           
            $this->db->where('class_id',$class_id);
            $query = $this->db->get('section')->result_array();         
            
            if (!empty($query)):
                foreach ($query as $row):
        ?>
            <div class="tab-pane" id="<?php 
                        echo $row['section_id'];
                        $section_id = $row['section_id'];
                        ?>">
            <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('id'); ?></th>
                            <th width="80"><div><?php echo get_phrase('roll');?></div></th>
                            <th width="80"><div><?php echo get_phrase('shift');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('father_name');?></div></th>
                            <th><div><?php echo get_phrase('mobile');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $this->db->order_by('roll', 'ASC');
                                $this->db->where('class_id', $class_id);
                                if(!empty($group_id)) {
                                    $this->db->where('group_id',$group_id);    
                                }
                                $this->db->where('section_id', $section_id);
                                $this->db->where('year', $running_year);
                                $students   =   $this->db->get('enroll')->result_array();
                                foreach($students as $row):?>
                        <tr>
                            <td><?php echo $row['student_id'];?></td>
                            <td><?php echo $row['roll'];?></td>
                            <td>
                                <?php 

                                    echo $this->db->get_where('shift',['shift_id'=>$row['shift_id']])->row()->name; 
                                ?>
                            </td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td>
                                <?php 
                                
                                    $this->db->where('student_id',$row['student_id']);
                                    echo $this->db->get('student')->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $this->db->where('student_id',$row['student_id']);
                                    echo $this->db->get('student')->row()->fname;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $this->db->where('student_id',$row['student_id']);
                                    echo $this->db->get('student')->row()->mobile;
                                ?>
                            </td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- STUDENT MARKSHEET LINK  -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php?admin/student_marksheet/<?php echo $row['student_id'];?>">
                                                <i class="entypo-chart-bar"></i>
                                                    <?php echo get_phrase('mark_sheet');?>
                                            </a>
                                        </li>
                                        
                                        <!-- STUDENT PROFILE LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-user"></i>
                                                    <?php echo get_phrase('profile');?>
                                            </a>
                                        </li>
                                        
                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
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
        <?php endforeach;?>
        <?php endif;?>


        <?php            
            $this->db->where('class_id',$class_id);
            $query = $this->db->get('section')->result_array();   
            if (!empty($query)):
                foreach ($query as $row):
        ?>
        <div class="tab-pane" id="<?php echo $row['section_id']; ?>_fees">
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><b><?php echo get_phrase('no'); ?></b></th>
                            <th><b><?php echo get_phrase('name');?></b></th>
                            <th><b><?php echo get_phrase('fees');?></b></th>
                            <th><b><?php echo get_phrase('total');?></b></th>
                        </tr>
                    </thead>
                    <form action="<?php echo base('a/accounting', 'add_student_income') ?>" method="post">
                    <tbody>
                        <?php 
                                $class_total = 0;
                                $this->db->order_by('roll', 'ASC');
                                $this->db->where('class_id', $class_id);
                                if(!empty($group_id)) {
                                    $this->db->where('group_id',$group_id);    
                                }
                                $this->db->where('section_id', $row['section_id']);
                                $this->db->where('year', $running_year);
                                $students   =   $this->db->get('enroll')->result_array();
                                $months_total = 0;
                                sort($students); // roll string to int convertion and sort
                                foreach($students as $k=>$row):
                                    $this->db->where('student_id',$row['student_id']);
                                    $fee_month = $this->db->get('student_fees')->result_array();
                                    $months_total = explode(',', $fee_month[0]['month']);
                        ?>
                        <tr>
                            <td><?php echo $row['roll']; ?></td>
                            <td>
                                <?php 
                                    $this->db->where('student_id',$row['student_id']);
                                    echo '<b>'.$this->db->get('student')->row()->name.'</b>';
                                ?>
                            </td>
                            
                            <td>
                            <?php 
                            $total_amount = 0;
                            $this->db->where('student_id',$row['student_id']);
                            $this->db->where('year',$running_year);
                            $student_invoice = $this->db->get('invoice')->result_array(); 
                            if(!empty($student_invoice)):
                                foreach($student_invoice as $each_in): 
                                    $fee_name = explode(',', $each_in['fee_name']);
                                    $amount   = explode(',', $each_in['fee_amount']);
                                    $total_amount +=  array_sum($amount);
                                    $class_total +=  array_sum($amount);
                                ?>
                                <span>
                                <?php 
                                foreach($fee_name as $k=>$each_fee):
                                    if($each_fee == 'tuition_fee'){
                                        echo $each_in['months'].' ('.$amount[$k].') <b>|</b> ';
                                    }else{
                                        echo ucwords(str_replace('_',' ',$each_fee)).' ('.$amount[$k].') <b>|</b> ';
                                    }
                                endforeach; ?>
                                    
                                </span> 
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </td>
                           
                            <td>
                                <span>Total: <?php echo $total_amount; ?> tk.</span> 
                            </td>                            
                        </tr>
                        
                        <?php endforeach;?>
                        <tr>
                            <td>
                                <!-- <input type="submit" class="btn btn-primary" value="Save"> -->
                            </td>
                            <td colspan="2"></td>
                            <td>
                                <span>Total: <?php echo $class_total; ?> tk.</span>
                            </td>
                        </tr>
                        
                    </tbody>
                    </form>
                </table>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        
    </div>
</div>




<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
    	var datatable = $("#table_export2").dataTable({
            "aLengthMenu": [[1, 2, -1], [1, 2, "All"]],
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>