<div class="sidebar-menu">
    <header class="logo-env">

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png" style="max-height:60px;" />
            </a>
        </div>
    </header>

    <div style=""></div>
    <div class="content">
        <ul class="vertical-nav dark red">

            <!-- DASHBOARD SECTION -->

            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/dashboard">
                    <i class="entypo-gauge"></i>
                    <?php echo get_phrase('dashboard'); ?>
                </a>
            </li>

            <!-- MANAGE HOME SECTION -->

            <li class="<?php if ($page_name == 'menus/manage_home_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?homemanage/manageHomeMenu">
                    <i class="entypo-window"></i>
                    <?php echo get_phrase('manage_home'); ?>
                </a>
            </li>

            <!-- MANAGE STUDENT SECTION -->

            <li class="<?php if ($page_name == 'menus/student_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/student_menu">
                    <i class="entypo-rocket"></i>
                    <?php echo get_phrase('student'); ?>
                </a>
            </li>

            <!-- MANAGE ADMISSION SECTION -->

            <li class="<?php if ($page_name == 'menus/admission_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?homemanage/admission_menu">
                    <i class="entypo-layout"></i>
                    <?php echo get_phrase('admission'); ?>
                </a> 
            </li>

            <!-- MANAGE TESTIMONIAL SECTION -->

            <li class="<?php if ($page_name == 'menus/testimonial_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/testimonial_menu">
                    <i class="entypo-trophy"></i>
                    <?php echo get_phrase('testimonial'); ?>
                </a>
            </li>

            <!-- TEACHERS SECTION -->

            <li class="<?php if ($page_name == 'menus/teacher_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/teacherMenu">
                    <i class="entypo-users"></i>
                    <?php echo get_phrase('teacher'); ?>
                </a>
            </li>

            <!-- PARENT SECTION -->

            <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/parent">
                    <i class="entypo-user"></i>
                    <?php echo get_phrase('parents'); ?>
                </a>
            </li>

            <!-- LIBRARIAN SECTION -->

            <?php if($_SESSION['name']=='NihalIT'): ?>
            <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/librarian">
                    <i class="entypo-book"></i>
                    <?php echo get_phrase('librarian'); ?>
                </a>
            </li>
            <?php endif; ?>

            <!-- CLASS SECTION -->

            <li class="<?php if ($page_name == 'menus/class_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/class_menu">
                    <i class="entypo-flow-tree"></i>
                    <?php echo get_phrase('class'); ?>
                </a>
            </li>

            <!-- SUBJECT SECTION -->

            <li class="<?php if ($page_name == 'menus/subject_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/subject_menu">
                    <i class="entypo-docs"></i>
                    <?php echo get_phrase('subject'); ?>
                </a>
            </li>

            <!-- CLASS ROUTINE SECTION -->

            <li class="<?php if ($page_name == 'class_routine_view') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/class_routine_view">
                    <i class="entypo-target"></i>
                    <?php echo get_phrase('class_routine'); ?>
                </a>
            </li>

            <!-- MANAGE ATTENDANCE SECTION -->

            <li class="<?php if ($page_name == 'menus/attendance_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/attendance_menu">
                    <i class="entypo-chart-area"></i>
                    <?php echo get_phrase('daily_attendance'); ?>
                </a>
            </li>

            <!-- MANAGE EXAM SECTION -->

            <li class="<?php if ($page_name == 'menus/exam_menu') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/exam_menu">
                    <i class="entypo-graduation-cap"></i>
                    <?php echo get_phrase('exam'); ?>
                </a>
            </li>


            <!-- MANAGE SMS SECTION -->

            <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/message">
                    <i class="entypo-mail"></i>
                    <?php echo get_phrase('message'); ?>
                </a>
            </li>


            <!-- MANAGE PROFILE SECTION -->

            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?teacher/manage_profile">
                    <i class="entypo-lock"></i>
                    <?php echo get_phrase('account'); ?>
                </a>
            </li>

        </ul>
    </div>

</div>