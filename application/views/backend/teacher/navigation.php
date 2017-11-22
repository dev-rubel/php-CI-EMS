    <div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>
    </header>

    <div style=""></div>    
    <div class="content">
         <ul class="vertical-nav dark red">

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' ||
                $page_name == 'student_information' ||
                $page_name == 'student_marksheet')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <?php echo get_phrase('student'); ?>
                <span class="submenu-icon"></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_add">
                        <?php echo get_phrase('admit_student'); ?>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li><a href="#"><?php echo get_phrase('student_information'); ?> <span class="submenu-icon"></span></a>
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
                                            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_information/<?php echo $row['class_id'].'/'.$each['group_id']; ?>">
                                                <?php echo get_phrase($each['name']); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>

                        <?php else: ?>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_information/<?php echo $row['class_id']; ?>">
                                    <?php echo get_phrase('class').' '.$row['name']; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                  </li>

            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>



        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <?php echo get_phrase('subject'); ?>
                <span class="submenu-icon"></span>
            </a>
            <ul>
<?php $classes = $this->db->get('class')->result_array();
foreach ($classes as $row):
    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
<?php endforeach; ?>
            </ul>
        </li>

            <!-- CLASS ROUTINE SECTION -->
            <li class="<?php
        if ($page_name == 'class_routine_view' ||
                $page_name == 'class_routine_add')
            echo 'active';
        ?> "><a href="#"><i class="entypo-target"></i> <?php echo get_phrase('class_routine'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li>
                        <a href="#">
                            <?php echo get_phrase('class').' '.$row['name']; ?>
                            <span class="submenu-icon"></span>
                        </a>
                        <?php $cGroups = $this->db->get_where('group', array('class_id'=>$row['class_id']))->result_array(); 
                            if(count($cGroups)):                                
                        ?>
                        <ul>
                            <?php foreach($cGroups as $eachGro): ?>
                            <li>
                                <a href="#"><?php echo ucfirst($eachGro['name']); ?>
                                    <span class="submenu-icon"></span>
                                </a>
                                <ul>
                                <?php $sName = $this->db->get('shift')->result_array(); 
                                    foreach($sName as $eachShift):
                                ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php?teacher/class_routine_view/<?php echo $row['class_id'].'/'.$eachGro['group_id'].'/'.$eachShift['shift_id'].'/G'; ?>"><?php echo $eachShift['name']; ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php else: ?>
                        <?php $cSections = $this->db->get_where('section', array('class_id'=>$row['class_id']))->result_array();                                
                        ?>
                        <ul>
                            <?php foreach($cSections as $eachSec): ?>
                            <li>
                                <a href="#"><?php echo $eachSec['name']; ?>
                                    <span class="submenu-icon"></span>
                                </a>
                                <ul>
                                <?php $sName = $this->db->get('shift')->result_array(); 
                                    foreach($sName as $eachShift):
                                ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php?teacher/class_routine_view/<?php echo $row['class_id'].'/'.$eachSec['section_id'].'/'.$eachShift['shift_id']; ?>"><?php echo $eachShift['name']; ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </li>
        
		<!-- STUDY MATERIAL -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('study_material'); ?></span>
            </a>
        </li>

        <!-- ACADEMIC SYLLABUS -->
        <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/academic_syllabus">
                <i class="entypo-doc"></i>
                <span><?php echo get_phrase('academic_syllabus'); ?></span>
            </a>
        </li>

        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance' ||
                                $page_name == 'manage_attendance_view') 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <?php echo get_phrase('daily_attendance'); ?>
                <span class="submenu-icon"></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view') && $class_id == $row['class_id']) echo 'active'; ?>">

                    <?php $groups = $this->db->get_where('group', array('class_id' => $row['class_id']))->result_array(); ?>

                    <?php if(!empty($groups)): ?>
                        <a href="#">
                            <?php echo get_phrase($row['name']); ?>
                            <span class="submenu-icon"></span>
                        </a>
                        <ul>
                            <?php foreach($groups as $each): ?>
                                <li>
                                <a href="<?php echo base_url(); ?>index.php?teacher/manage_attendance/<?php echo $row['class_id'].'/'.$each['group_id']; ?>">
                                    <span><?php echo ucwords($each['name']); ?></span>
                                </a>
                                    
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php else: ?>
                        <a href="<?php echo base_url(); ?>index.php?teacher/manage_attendance/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>

                    <?php endif; ?>
                        
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- EXAMS -->
        <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view' || $page_name == 'question_paper') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <?php echo get_phrase('exam'); ?>
                <span class="submenu-icon"></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/marks_manage">
                        <?php echo get_phrase('manage_marks'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'question_paper') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/question_paper">
                        </span><?php echo get_phrase('question_paper'); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/book">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
        </li>

        <!-- TRANSPORT -->
        <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/transport">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>
  </div>

</div>