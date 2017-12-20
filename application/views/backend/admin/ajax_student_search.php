<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Roll</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Mobile</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $class_id; ?></td>
            <td>John</td>
            <td>Carter</td>
            <td>johncarter@mail.com</td>
            <td>johncarter@mail.com</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                        <!-- STUDENT MARKSHEET LINK  -->
                        <li>
                            <a href="<?php echo base_url();?>index.php?admin/student_marksheet/<?php echo 1;?>">
                                <i class="entypo-chart-bar"></i>
                                    <?php echo get_phrase('mark_sheet');?>
                                </a>
                        </li>

                        
                        <!-- STUDENT PROFILE LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_profile/<?php echo 1;?>');">
                                <i class="entypo-user"></i>
                                    <?php echo get_phrase('profile');?>
                                </a>
                        </li>
                        
                        <!-- STUDENT EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo 1;?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                                </a>
                        </li>

                        <?php if($_SESSION['name']=='NihalIT'):?>
                        <!-- STUDENT DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/delete/<?php echo 1;?>');">
                                <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete');?>
                            </a>
                        </li>  
                        <?php endif; ?> 
                    </ul>
                </div>
            </td>
        </tr>
    </tbody>
</table>