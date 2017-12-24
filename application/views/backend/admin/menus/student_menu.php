<style>
.panel-stat3 h2,h4{
    color: #fff;
}
</style>
<br>
<br>
<?php 
$links = ['student_add','admit_bulk_student','total_student_page','student_promotion','download_excel'];
$title = ['Admit New Student','Admit Bulk Student','Total Student','Student Promotion','Download Excel'];
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="<?php echo base_url(); ?>index.php?admin/<?php echo $each?>">
            <div class="panel-stat3 bg-info<?php //echo $color[rand(1,7)];?>">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-3x"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
</div>
<hr>
<h3>Student Information</h3>
<hr>

<ul>
    <?php
    $classes = $this->db->get('class')->result_array();
    foreach ($classes as $row):
        $groupName = $this->db->get_where('group', array('class_id' => $row['class_id']))->result_array();
        if(!empty($groupName)):
        ?>
    
        <li>
            <a href="#"><?php echo get_phrase('class').' '.$row['name']; ?> <span class="submenu-icon"></span></a>
            <ul>
                <?php foreach($groupName as $each): ?>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id'].'/'.$each['group_id']; ?>">
                            <?php echo get_phrase($each['name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

    <?php else: ?>
        <li>
            <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                <?php echo get_phrase('class').' '.$row['name']; ?>
            </a>
        </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>