<hr />
<?php
if(isset($group_id)){
    $query = $this->db->get_where('section' , array('class_id' => $class_id)); 
}else{
    $query = $this->db->get_where('section' , array('section_id' => $section_id));
    $group_id = '';
}
    if($query->num_rows() > 0):
        $class_sections = $query->result_array();
    foreach($class_sections as $row):
?>
<div class="row">
    
    <div class="col-md-12">

        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading" >
                <div class="panel-title" style="font-size: 16px; color: black; text-align: center;">
                    <?php echo get_phrase('class');?> - <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
                    <?php echo get_phrase('section');?> - <?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?>
                    
                    <?php $groupName = $this->db->get_where('group' , array('group_id' => $group_id))->row()->name;
                        if(!empty($groupName)):
                    ?>
                    <?php echo get_phrase('group');
                            echo ' - '.ucwords($groupName);
                        endif;
                    ?>

                    <?php echo get_phrase('shift');?> - <?php echo $this->db->get_where('shift' , array('shift_id' => $shift_id))->row()->name;?>
                    <a href="<?php echo base_url();?>index.php?teacher/class_routine_print_view/<?php echo 
                    $class_id.'/'.
                    $row['section_id'].'/'.
                    $shift_id.'/'.
                    $group_id;
                    ?>" class="btn btn-primary btn-xs pull-right" target="_blank">
                            <i class="entypo-print"></i> <?php echo get_phrase('print');?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                
                <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
                    <tbody>
                        <?php 
                        for($d=1;$d<=7;$d++):
                        
                        if($d==1)$day='sunday';
                        else if($d==2)$day='monday';
                        else if($d==3)$day='tuesday';
                        else if($d==4)$day='wednesday';
                        else if($d==5)$day='thursday';
                        else if($d==6)$day='friday';
                        else if($d==7)$day='saturday';
                        ?>
                        <tr class="gradeA">
                            <td width="100"><?php echo strtoupper($day);?></td>
                            <td>
                                <?php
                                $this->db->order_by("time_start", "asc");
                                $this->db->where('day' , $day);
                                $this->db->where('class_id' , $class_id);
                                $this->db->where('section_id' , $row['section_id']);
                                $this->db->where('group_id' , $group_id);
                                $this->db->where('shift_id' , $shift_id);
                                $this->db->where('year' , $running_year);
                                $routines   =   $this->db->get('class_routine')->result_array();
                                foreach($routines as $row2):
                                ?>
                                <div class="btn-group">
                                    <button class="btn btn-default">
                                        <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
                                        <?php
                                            if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                                                echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                                            if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                                                echo '('.$row2['time_start'].':'.$row2['time_start_min'].'-'.$row2['time_end'].':'.$row2['time_end_min'].')';
                                        ?>
                                    </button>
                                   
                                </div>
                                <?php endforeach;?>

                            </td>
                        </tr>
                        <?php endfor;?>
                        
                    </tbody>
                </table>
                
            </div>
        </div>

    </div>

</div>
<?php endforeach;?>
<?php endif;?>